<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

final class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            return route('login');
        }

        return null;
    }
}
