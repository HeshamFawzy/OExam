<?php

namespace App\Http\Middleware;

use Closure;

class basicadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role == 'BasicAdmin'){
            return $next($request);
        } else {
          abort(404);
        }
    }
}
