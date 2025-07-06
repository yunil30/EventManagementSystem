<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function showLoginForm() {
        return view('authentication.LoginUser');
    }
    
    public function login(Request $request) {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);

        $user = UserModel::where('user_name', $request->user_name)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->UserID,
                'user_name' => $user->user_name,
                'user_role' => $user->user_role,
            ]);

            
            $request->session()->regenerate();

            return redirect()->route('ShowListOfUsers'); 
        }

        return back()->withErrors(['login' => 'Invalid credentials.']);
    }

    public function ShowListOfUsers() {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        return view('ListOfUsers');
    }

    public function logout() {
        Session::flush(); 

        return redirect()->route('login');
    }

    public function GetAllUsers() 
    {
        $users = UserModel::all();

        return response()->json($users);
    }

    public function GetActiveUsers() 
    {
        $users = UserModel::where('user_status', 1)->get();

        return response()->json($users);
    }

    public function GetUserRecord($UserID) 
    {
        $user = UserModel::where('UserID', $UserID)->where('user_status', 1)->first(); 

        return response()->json($user);
    }

    public function CreateUserRecord(Request $request) 
    {
        $request->validate([
            'first_name' => 'required|string|max:145',
            'last_name' => 'required|string|max:145',
            'user_name' => 'required|string|max:50|unique:tbl_user_access,user_name',
            'user_email' => 'required|email|max:50|unique:tbl_user_access,user_email',
            'contact_number' => 'required',
            'password' => 'required|string|min:8', 
            'user_role' => 'required|string|in:user,admin',
        ]);
    
        $hashedPassword = Hash::make($request->input('password'));
    
        $user = UserModel::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_name' => $request->input('user_name'),
            'user_email' => $request->input('user_email'),
            'contact_number' => $request->input('contact_number'),
            'password' => $hashedPassword,
            'user_role' => $request->input('user_role'),
            'user_status' => 1,
        ]);
    
        return response()->json(['message' => 'User created successfully!']);
    }

    public function EditUserRecord(Request $request, $UserID) 
    {
        $request->validate([
            'first_name' => 'required|string|max:145',
            'last_name' => 'required|string|max:145',
            'user_name' => 'required|string|max:50|unique:tbl_user_access,user_name,' . $UserID . ',UserID',
            'user_email' => 'required|email|max:50|unique:tbl_user_access,user_email,' . $UserID . ',UserID',
            'contact_number' => 'required',
            'user_role' => 'required|string|in:user,admin',
        ]);
    
        $user = UserModel::find($UserID);
    
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->user_name = $request->input('user_name');
        $user->user_email = $request->input('user_email');
        $user->contact_number = $request->input('contact_number');
        $user->user_role = $request->input('user_role');
        $user->save();
    
        return response()->json(['message' => 'User information updated successfully!']);
    }

    public function RemoveUserRecord(Request $request, $UserID) 
    {
        $user = UserModel::find($UserID);
    
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $user->user_status = 0;
        $user->save();
    
        return response()->json(['message' => 'User status updated successfully!']);
    }
}
