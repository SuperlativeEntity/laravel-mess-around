<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguagesTableSeeder extends Seeder
{
    protected $table  = 'languages';
    protected $values =
    [
        'English',
        'Afrikaans',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new Language();
            $model->name    = $value;
            $model->save();
        }
    }
}