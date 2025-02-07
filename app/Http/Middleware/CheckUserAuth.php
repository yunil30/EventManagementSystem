<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUserAuth
{
    public function handle(Request $request, Closure $next)
    {
        $user = session('user');

        if (!$user) {
            // return redirect()->route('ShowListOfUsers');
        } 

        return $next($request);
    }

    // public function handle(Request $request, Closure $next) 
    // {
    //     $meUser = 1; 

    //     if ($meUser === 0) {
    //         return response()->json(['message' => 'Access denied: You are inactive.'], 403);
    //     }

    //     return $next($request);
    // }
}
