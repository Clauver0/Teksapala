<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAny
{
    public function handle(Request $request, Closure $next)
    {
        foreach (['donatur', 'komunitas'] as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::shouldUse($guard); // setelah ini Auth::user() otomatis benar
                return $next($request);
            }
        }

        return redirect()->guest(route('login'));
    }
}