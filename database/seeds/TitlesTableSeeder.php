<?php

use Illuminate\Database\Seeder;
use App\Title;

class TitlesTableSeeder extends Seeder
{
    protected $table  = 'titles';
    protected $values =
    [
        'Mr.',
        'Mrs.',
        'Miss.',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new Title();
            $model->name    = $value;
            $model->save();
        }
    }
}