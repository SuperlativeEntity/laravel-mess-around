<?php

use Illuminate\Database\Seeder;
use App\CampaignType;

class CampaignTypesTableSeeder extends Seeder
{
    protected $table  = 'campaign_types';
    protected $values =
    [
        2 => 'Email',
        3 => 'Sms',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $key => $value)
        {
            $model          = new CampaignType();
            $model->id      = $key;
            $model->name    = $value;
            $model->save();
        }
    }
}