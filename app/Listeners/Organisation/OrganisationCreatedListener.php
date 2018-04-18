<?php

namespace App\Listeners\Organisation;

use App\Events\Organisation\OrganisationCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrganisationCreatedListener
{
    public function __construct()
    {
    }

    public function handle(OrganisationCreatedEvent $event)
    {
        \Log::info('OrganisationCreatedEvent Triggered from OrganisationCreatedListener',['event' => $event]);
    }
}
