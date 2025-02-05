<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class UserController extends Controller 
{
    public function ShowListOfUsers()
    {
        return view('ListOfUsers');
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
}
