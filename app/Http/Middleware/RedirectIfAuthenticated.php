<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
            if((Auth::user()->roles->pluck('role_name')->contains('SUPERADMIN')))
                return redirect(RouteServiceProvider::HOME);
            else if((Auth::user()->roles->pluck('role_name')->contains('ADMIN')))
                return redirect(RouteServiceProvider::ADMIN);
            else
                return redirect(RouteServiceProvider::USER);
        }

        return $next($request);
    }
}
