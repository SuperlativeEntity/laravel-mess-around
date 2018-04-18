<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\IActivityRepository as ActivityRepository;
use App\Repositories\IUserRepository as UserRepository;

class UserActivity
{
    protected $activity;
    protected $user;

    public function __construct(ActivityRepository $activity,UserRepository $user)
    {
        $this->user     = $user;
        $this->activity = $activity;
    }

    public function handle($request, Closure $next)
    {
        $user = $this->user->get();

        if (isset($user))
        {
            $args =
            [
                'userId'        => $user->id,
                'contentId'     => $user->id,
                'contentType'   => 'Route',
                'action'        => $request->method(),
                'description'   => $request->path(),
                'details'       => $user->email
            ];

            $this->activity->log($args);
        }

        return $next($request);
    }
}
