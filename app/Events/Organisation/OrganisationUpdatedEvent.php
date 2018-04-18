<?php

namespace App\Events\Organisation;

use App\Organisation;
use App\Events\Event;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

// implements ShouldBroadcast

class OrganisationUpdatedEvent extends Event
{
    use SerializesModels;

    public $request;
    public $organisation;

    public function __construct(Organisation $organisation)
    {
        $this->organisation = $organisation;
    }

    public function broadcastOn()
    {
        //return new Channel('organisation.update.'.$this->organisation->id);
        return [];
    }
}