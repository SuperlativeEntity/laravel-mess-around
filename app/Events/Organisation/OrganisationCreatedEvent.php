<?php

namespace App\Events\Organisation;

use App\Organisation;
use App\Events\Event;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrganisationCreatedEvent extends Event
{
    use SerializesModels;

    protected $request;
    protected $organisation;

    public function __construct(Request $request,Organisation $organisation)
    {
        $this->organisation     = $organisation;
        $this->request          = $request;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
