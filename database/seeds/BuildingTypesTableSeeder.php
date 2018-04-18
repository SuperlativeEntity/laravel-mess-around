<?php

use Illuminate\Database\Seeder;
use App\BuildingType;

class BuildingTypesTableSeeder extends Seeder
{
    protected $table  = 'building_types';
    protected $values =
    [
        'Farm',
        'Unit',
        'Stand',
        'Lodge',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new BuildingType();
            $model->name    = $value;
            $model->save();
        }
    }
}