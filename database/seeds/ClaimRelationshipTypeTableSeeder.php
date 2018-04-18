<?php

use Illuminate\Database\Seeder;
use App\ClaimRelationshipType;

class ClaimRelationshipTypeTableSeeder extends Seeder
{
    protected $table  = 'claim_relationship_types';
    protected $values =
    [
        'Owner',
        'Shareholder',
        'Child',
        'Other',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new ClaimRelationshipType();
            $model->name    = $value;
            $model->save();
        }
    }
}