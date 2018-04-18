<?php

use Illuminate\Database\Seeder;
use App\Choice;

class ChoicesTableSeeder extends Seeder
{
    protected $table    = 'choices';
    protected $values   =
    [
        'Yes',
        'No',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new Choice();
            $model->name    = $value;
            $model->save();
        }
    }
}