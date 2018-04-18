<?php

use Illuminate\Database\Seeder;
use App\DocumentType;

class DocumentTypesTableSeeder extends Seeder
{
    protected $table  = 'document_types';
    protected $values =
    [
        'ID Document',
        'CR 6 Company Registration Document',
        'CR14 Company Registration Document',
        'Title Deed',
        'Detailed description of all losses to be claimed for',
        'Copy of latest valuation Report',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new DocumentType();
            $model->name    = $value;
            $model->save();
        }
    }
}