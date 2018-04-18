<?php

namespace App\Console\Commands\Setup;

use Illuminate\Console\Command;
use App\Helpers\IDatabaseHelper as MySQLDatabaseHelper;

// php artisan create:database mess_around

class CreateDatabase extends Command
{
    protected $signature    = 'create:database {name}';
    protected $description  = 'Create Database';
    protected $helper;

    public function __construct(MySQLDatabaseHelper $helper)
    {
        $this->helper = $helper;

        parent::__construct();
    }

    public function handle()
    {
        $this->helper->createDatabase(strtolower($this->argument('name')));
    }
}
