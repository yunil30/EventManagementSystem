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
            // return redirect()->route('login');
        } 

        return $next($request);
    }
}
