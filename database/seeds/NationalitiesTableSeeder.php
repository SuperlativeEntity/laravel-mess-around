<?php

use Illuminate\Database\Seeder;
use App\Nationality;

class NationalitiesTableSeeder extends Seeder
{
    protected $table  = 'nationalities';
    protected $values =
    [
        'Zimbabwean',
        'South African',
        'Other'
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new Nationality();
            $model->name    = $value;
            $model->save();
        }
    }
}