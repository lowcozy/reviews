<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Sentinel;

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
        if (Sentinel::check()) {
            if(Sentinel::getUser()->inRole('admin'))
                {
                    return redirect()->route('admin.dashboard');
                }
            else
            return redirect('/home');
        }

        return $next($request);
    }
}
