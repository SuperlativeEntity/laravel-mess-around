<?php

namespace App\Listeners\Organisation;

use App\Events\Organisation\OrganisationRelationshipChangedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrganisationRelationshipChangedEventListener
{
    public function __construct()
    {
    }

    public function handle(OrganisationRelationshipChangedEvent $event)
    {
        \Log::info('OrganisationRelationshipChangedEventListener Triggered',['event' => $event]);
    }
}