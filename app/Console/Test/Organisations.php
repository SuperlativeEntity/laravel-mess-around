<?php

namespace App\Console\Commands\Test;

use App\Organisation;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;

// php artisan test:organisations single 1 (get specific organisation)
// php artisan test:organisations single 1 addresses (get specific organisation with address(es))
// php artisan test:organisations single 1 buildings (get specific organisation with building(s))
// php artisan test:organisations single 1 addresses,buildings (get specific organisation with both)
// php artisan test:organisations parents 1 (get all parent records for organisation id 1)
// php artisan test:organisations children 2 (get all child records for organisation id 2)

class Organisations extends Command
{
    protected $signature    = 'test:organisations {type} {id} {with?}';
    protected $description  = 'Test retrieval of Organisations and their relations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //\DB::enableQueryLog();

        try
        {
            $type           = strtolower($this->argument('type'));
            $id             = (int)$this->argument('id');
            $organisation   = null;

            if (isset($id))
            {
                $organisation = Organisation::findOrFail($id);
            }

            if (Str::contains(strtolower($type),'parent'))
                $this->findParents($id);

            if (Str::contains(strtolower($type),'child'))
            {
                $this->info($organisation->name);
                $this->findChildren($id);
            }

            if ($type == 'single')
                $this->find($id);
        }
        catch (ModelNotFoundException $e)
        {
            $this->error($e->getMessage());
        }

        // output queries if need be
        //$queries = \DB::getQueryLog();

    }

    public function children(&$data,Organisation $organisation)
    {
        if ($organisation->child->count() === 0)
            return $data;

        if ($organisation->child->count() > 0)
        {
            foreach ($organisation->child as $child)
            {
                array_push($data,$child);
                $this->children($data,$child);
            }
        }
    }

    public function parents(&$data,Organisation $organisation)
    {
        if ($organisation->parent->count() === 0)
            return $data;

        if ($organisation->parent->count() > 0)
        {
            foreach ($organisation->parent as $parent)
            {
                array_push($data,$parent);
                $this->parents($data,$parent);
            }
        }
    }

    public function childrenBuildings(&$data,$id)
    {
        $children = [];
        $this->children($children,Organisation::findOrFail($id)); // traverse all children

        if (count($children) === 0)
            return $data;

        if (count($children) > 0)
        {
            foreach ($children as $child)
            {
                if ($child->buildings->count() > 0)
                {
                    foreach ($child->buildings as $building)
                    {
                        array_push($data, $building);
                        $this->childrenBuildings($data, $child->id);
                    }
                }
            }
        }
    }

    public function findChildren($id)
    {
        $children = [];
        $this->children($children,Organisation::findOrFail($id));

        if (count($children) === 0)
        {
            $this->error('Could not find any children');
        }

        if (count($children) > 0)
        {
            $this->info('Found '.count($children).' child(ren)');

            foreach ($children as $child)
            {
                $this->info($child->name);
            }
        }
    }

    public function findParents($id)
    {
        $parents = [];
        $this->parents($parents,Organisation::findOrFail($id));

        if (count($parents) === 0)
        {
            $this->error('Could not find any parents');
        }

        if (count($parents) > 0)
        {
            $this->info('Found '.count($parents).' parent(s)');

            foreach ($parents as $parent)
            {
                $this->info($parent->name);
            }
        }
    }

    public function find($id)
    {
        try
        {
            $organisation = Organisation::findOrFail($id);

            $this->info($organisation->name);

            $this->info('');

            if  (Str::contains(strtolower($this->argument('with')),'addresses'))
            {
                $addressCount = $organisation->addresses->count();
                $this->info($addressCount.' address(es)');

                if ($addressCount > 0)
                {
                    foreach ($organisation->addresses as $address)
                    {
                        $this->info($address->type->name.': '.$address->street_postbox);
                    }

                    $this->info('');
                }
            }

            if  (Str::contains(strtolower($this->argument('with')),'buildings'))
            {
                $buildingsCount = $organisation->buildings->count();

                if ((int)$buildingsCount === 0)
                {
                    $childBuildings = [];
                    $this->childrenBuildings($childBuildings,$organisation->id);

                    if (count($childBuildings) === 0)
                        $this->info($buildingsCount.' children don\'t have buildings');

                    $this->info(count($childBuildings).' building(s) via child relationship');

                    foreach ($childBuildings as $building)
                    {
                        $this->info($building->type->name.': '.$building->name);
                    }

                    $this->info('');
                }

                if ($buildingsCount > 0)
                {
                    $this->info($buildingsCount.' building(s) with direct relationship');

                    foreach ($organisation->buildings as $building)
                    {
                        $this->info($building->type->name.': '.$building->name);
                    }

                    $this->info('');
                }
            }
        }
        catch (ModelNotFoundException $e)
        {
            $this->error($e->getMessage());
        }
    }
}
