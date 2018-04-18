<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class SentinelCheck
{
    public function handle($request, Closure $next)
    {
        if (Sentinel::check() or $request->is("auth/login"))
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('auth.login');
        }
    }
}
