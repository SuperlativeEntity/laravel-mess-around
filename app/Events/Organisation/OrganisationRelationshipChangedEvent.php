<?php

namespace App\Events\Organisation;

use App\Organisation;
use App\Events\Event;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrganisationRelationshipChangedEvent extends Event
{
    use SerializesModels;

    protected $request;
    protected $currentParent;
    protected $newParent;

    public function __construct(Request $request,Organisation $currentParent,Organisation $newParent)
    {
        $this->currentParent    = $currentParent;
        $this->newParent        = $newParent;
        $this->request          = $request;

        \Log::info('OrganisationRelationshipChangedEvent Triggered',['currentParent' => $currentParent,'newParent' => $newParent]);
    }

    public function broadcastOn()
    {
        return [];
    }
}

