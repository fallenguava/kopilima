<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticateWithTimeout
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $lastActivity = Session::get('last_activity', now());
            $timeout = now()->diffInMinutes($lastActivity);

            // If timeout exceeds 5 minutes, log out the user
            if ($timeout > 5) {
                Auth::logout();
                Session::flush(); // Clear session data
                return redirect()->route('login')->withErrors(['message' => 'Session expired. Please log in again.']);
            }

            // Update last activity timestamp
            Session::put('last_activity', now());
        }

        return $next($request);
    }
}
