<?php

namespace App\Events\User;

use Illuminate\Queue\SerializesModels;

use App\Events\Event;
use App\Repositories\IUserRepository as UserRepository;
use App\Repositories\IActivityRepository as ActivityRepository;

class Authenticated extends Event
{
    use SerializesModels;

    protected $activity;
    protected $user;

    public function __construct(ActivityRepository $activity,UserRepository $user)
    {
        $this->user     = $user;
        $this->activity = $activity;

        $this->logActivity();
    }

    private function logActivity()
    {
        $user = $this->user->get();

        if (isset($user))
        {
            $args =
            [
                'userId'        => $user->id,
                'contentId'     => $user->id,
                'contentType'   => 'User',
                'action'        => 'Login',
                'description'   => 'User Logged In',
                'details'       => $user->email
            ];

            $this->activity->log($args);
        }
    }

    public function broadcastOn()
    {
        return ['user']; // channel name
    }
}
