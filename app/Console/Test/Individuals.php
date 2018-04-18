<?php

namespace App\Console\Commands\Test;

use App\Individual;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

// php artisan test:individuals single 1 (get specific individual)

class Individuals extends Command
{
    protected $signature    = 'test:individuals {type} {id} {with?}';
    protected $description  = 'Test retrieval of Individuals and their relations';
    protected $roles        = ['managing_agent','executive_chairman','chairman','director','member','trustee'];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try
        {
            $type       = strtolower($this->argument('type'));
            $id         = (int)$this->argument('id');

            //\DB::enableQueryLog();

            if ($type == 'single')
                $this->find($id);

            //$queries = \DB::getQueryLog();
            //dd($queries);
        }
        catch (ModelNotFoundException $e)
        {
            $this->error($e->getMessage());
        }

    }

    public function find($id)
    {
        try
        {
            if (isset($id))
            {
                $individual = Individual::findOrFail($id);

                if (isset($individual))
                {
                    $this->info($individual->first_name.' '.$individual->last_name);

                    foreach ($individual->organisations as $organisation)
                    {
                        $this->info($organisation->name.' AS '.$organisation->pivot->role_id);
                    }

                    foreach ($this->roles as $role)
                    {
                        $role_id = config('role.'.$role);

                        if ($individual->organisationsByRole($role_id)->count() > 0)
                        {
                            $this->info('');
                            $this->info(studly_case($role));
                            $this->info('');

                            foreach ($individual->organisationsByRole($role_id)->get() as $organisation)
                            {
                                $this->info($organisation->name);
                            }
                        }
                    }
                }
            }
        }
        catch (ModelNotFoundException $e)
        {
            $this->error($e->getMessage());
        }
    }
}
