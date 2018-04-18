<?php

use Illuminate\Database\Seeder;
use App\AddressType;

class AddressTypesTableSeeder extends Seeder
{
    protected $table  = 'address_types';
    protected $values =
    [
        'Postal Address',
        'Physical Address',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new AddressType();
            $model->name    = $value;
            $model->save();
        }
    }
}