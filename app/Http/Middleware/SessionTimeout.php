<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    /**
     * The time (in seconds) before the user is logged out due to inactivity.
     */
    protected $timeout = 300; // 5 minutes

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity_time');
            if ($lastActivity && time() - $lastActivity > $this->timeout) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', 'Your session has expired due to inactivity.');
            }
            session(['last_activity_time' => time()]);
        }

        return $next($request);
    }
}
