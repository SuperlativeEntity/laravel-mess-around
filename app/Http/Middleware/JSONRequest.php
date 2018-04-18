<?php

namespace App\Http\Middleware;

use Closure;

class JSONRequest
{
    // usage in jquery: JSON.stringify(form.serializeObject())
    public function handle($request, Closure $next)
    {
        $content = $request->getContent();

        if (strlen($content) > 0 && in_array($request->getMethod(), config('system.json_request_methods')))
            $request->merge(json_decode($content,true));

        return $next($request);
    }
}