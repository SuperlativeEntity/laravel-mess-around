<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware =
    [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        'Barryvdh\Cors\HandleCors',
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups =
    [
        'web' =>
        [
            'encrypt_cookies',
            'add_cookie_to_response',
            'session_start',
            'session_share_errors',
            'verify_csrf_token',
            'bindings',
            'pjax',
            'force_https',
            'json_request'
        ],

        'admin' =>
        [
            'web',              // web middleware group +
            'authenticated',    // check that the user is authenticated
            'has_access',       // check that the user has access to the route
            'session_active',   // check that the session is still active
            'individual_check', // if the user has an individual record, make sure the user account matches
            'log_activity',     // log the route the user accessed
            'json_request',     // process json requests
        ],

        'api' =>
        [
            'session_start', // required for sentinel
            'cors',
            'throttle:60,1',
            'json_request',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware =
    [
        'auth'                      => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'                => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'                  => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers'             => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'                       => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'                     => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'                  => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        'encrypt_cookies'           => \App\Http\Middleware\EncryptCookies::class,
        'add_cookie_to_response'    => \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        'session_start'             => \Illuminate\Session\Middleware\StartSession::class,
        'session_share_errors'      => \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        'verify_csrf_token'         => \App\Http\Middleware\VerifyCsrfToken::class,
        'pjax'                      => \App\Http\Middleware\FilterIfPjax::class,
        'force_https'               => \App\Http\Middleware\ForceHttps::class,
        'json_request'              => \App\Http\Middleware\JSONRequest::class,

        'authenticated'             => \App\Http\Middleware\SentinelCheck::class,
        'has_access'                => \App\Http\Middleware\SentinelHasAccess::class,
        'session_active'            => \App\Http\Middleware\SessionExpired::class,
        'individual_check'          => \App\Http\Middleware\IndividualCheck::class,
        'log_activity'              => \App\Http\Middleware\UserActivity::class,

        'jwt.auth'                  => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh'               => \Tymon\JWTAuth\Middleware\RefreshToken::class,
    ];
}
