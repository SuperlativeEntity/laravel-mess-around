<?php

namespace App\Console\Commands\Test;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

use App\Organisation;
use App\Events\Organisation\OrganisationUpdatedEvent;

// php artisan test:pusher
class Pusher extends Command
{
    protected $signature    = 'test:pusher';
    protected $description  = 'Test Pusher';
    protected $organisation;

    public function __construct(Organisation $organisation)
    {
        $this->organisation     = $organisation;

        parent::__construct();
    }

    public function handle()
    {
        $this->organisation = Organisation::findOrFail(1);

        event(new OrganisationUpdatedEvent($this->organisation));
    }
}