<?php

namespace App\Events\Individual;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Cartalyst\Sentinel\Users\EloquentUser;
use App\Individual;

class AccountCreatedEvent
{
    use InteractsWithSockets, SerializesModels;

    public $user;
    public $individual;

    public function __construct(EloquentUser $user,Individual $individual)
    {
        $this->user         = $user;
        $this->individual   = $individual;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}