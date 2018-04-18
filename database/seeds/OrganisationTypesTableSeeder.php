<?php

use Illuminate\Database\Seeder;
use App\OrganisationType;

class OrganisationTypesTableSeeder extends Seeder
{
    protected $table  = 'organisation_types';
    protected $values =
    [
        'Company',
        'Trust',
        'Private Individual',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new OrganisationType();
            $model->name    = $value;
            $model->save();
        }
    }
}