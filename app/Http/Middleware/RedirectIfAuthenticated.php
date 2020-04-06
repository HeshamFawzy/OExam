<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (auth()->user()->role == 'BasicAdmin') {
                return '/Basicindex';
            } else if (auth()->user()->role == 'Admin'){
                return '/Adminindex';
            } else if (auth()->user()->role == 'User'){
                return '/Userindex';
            } else {
                return '/verification';
            }
        }

        return $next($request);
    }
}
