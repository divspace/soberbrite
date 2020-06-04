<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

final class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect(route('home'));
        }

        return $next($request);
    }
}
