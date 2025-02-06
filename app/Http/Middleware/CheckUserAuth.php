<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class CheckUserAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if a user is stored in the session
        $user = session('user');
        // dd($user); 

        if (!$user) {
            // If no user session exists, redirect to login
            return redirect('/login');
        }

        // Optionally, you can also check if the user's status is active (1)
        if ($user->user_status !== 1) {
            // If the user is inactive (status 0), deny access
            return response()->json(['message' => 'Access denied: Your account is inactive.'], 403);
        }

        // Allow the request to proceed if user is authenticated and active
        return $next($request);
    }

    // public function handle(Request $request, Closure $next) {
    //     $meUser = 1; 

    //     if ($meUser === 0) {
    //         return response()->json(['message' => 'Access denied: You are inactive.'], 403);
    //     }

    //     return $next($request);
    // }
}
