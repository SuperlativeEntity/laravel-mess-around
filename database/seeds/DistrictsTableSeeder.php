<?php

use Illuminate\Database\Seeder;
use App\District;

class DistrictsTableSeeder extends Seeder
{
    protected $table    = 'districts';
    protected $values   =
    [
        'District A',
        'District B',
        'District C',
        'District D',
        'District 9',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new District();
            $model->name    = $value;
            $model->save();
        }
    }
}