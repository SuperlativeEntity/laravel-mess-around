<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen =
    [
        'App\Events\User\Authenticated'                                 => ['App\Listeners\User\LoggedIn'],
        'App\Events\User\Logout'                                        => ['App\Listeners\User\LoggedOut'],
        'App\Events\Organisation\OrganisationCreatedEvent'              => ['App\Listeners\Organisation\OrganisationCreatedListener'],
        'App\Events\Organisation\OrganisationUpdatedEvent'              => ['App\Listeners\Organisation\OrganisationUpdatedListener'],
        'App\Events\Organisation\OrganisationRelationshipChangedEvent'  => ['App\Listeners\Organisation\OrganisationRelationshipChangedEventListener'],
        'App\Events\Individual\AccountCreatedEvent'                     => ['App\Listeners\Individual\AccountCreatedListener'],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
