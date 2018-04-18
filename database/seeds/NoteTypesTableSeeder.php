<?php

use Illuminate\Database\Seeder;
use App\NoteType;

class NoteTypesTableSeeder extends Seeder
{
    protected $table  = 'note_types';
    protected $values =
    [
        'General',
        'Important!'
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new NoteType();
            $model->name    = $value;
            $model->save();
        }
    }
}