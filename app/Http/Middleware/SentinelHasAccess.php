<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class SentinelHasAccess
{
    public function handle($request, Closure $next)
    {
        $user = Sentinel::getUser();

        if (isset($user) && $user->hasAccess([$request->route()->getName()]))
            return $next($request);

        return response()->view('errors.json', ['error' => trans('errors.not_authorised')], 401);
    }
}