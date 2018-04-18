<?php

namespace App\Listeners\Individual;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Jobs\Individual\AccountCreatedJob;
use App\Events\Individual\AccountCreatedEvent;

class AccountCreatedListener
{
    public function __construct()
    {
    }

    public function handle(AccountCreatedEvent $event)
    {
        // dispatch job to send email
        dispatch(new AccountCreatedJob($event->user,$event->individual));
    }
}
