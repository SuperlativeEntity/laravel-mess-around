<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands =
    [
        Commands\Test\Organisations::class,
        Commands\Test\Individuals::class,
        Commands\Test\Pusher::class,
        Commands\Setup\CreateDatabase::class,
    ];

    protected function schedule(Schedule $schedule)
    {
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
