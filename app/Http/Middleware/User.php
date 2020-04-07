<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
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
        if (Auth::check()) {
            if((Auth::user()->roles->pluck('role_name')->contains('SUPERADMIN'))||(Auth::user()->roles->pluck('role_name')->contains('ADMIN')))
                return redirect('/permissiondenie');
        }
        return $next($request);
    }
}
