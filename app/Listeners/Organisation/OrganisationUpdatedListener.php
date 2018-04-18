<?php

namespace App\Listeners\Organisation;

use App\Events\Organisation\OrganisationUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrganisationUpdatedListener
{
    public function __construct()
    {
    }

    public function handle(OrganisationUpdatedEvent $event)
    {
        \Log::info('OrganisationUpdatedEvent Triggered from OrganisationUpdatedListener',[]);
    }
}