<?php

use Illuminate\Database\Seeder;
use App\CampaignCategory;

class CampaignCategoriesTableSeeder extends Seeder
{
    protected $table  = 'campaign_categories';
    protected $values =
    [
        2 => 'Communication',
        3 => 'Marketing',
        4 => 'Meeting',
        5 => 'Negotiations',
        6 => 'Organisers',
        8 => 'Training',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $key => $value)
        {
            $model          = new CampaignCategory();
            $model->id      = $key;
            $model->name    = $value;
            $model->save();
        }
    }
}