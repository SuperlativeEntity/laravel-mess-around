<?php

// config('campaign.sms')
return
    [
        'email'                             => 2,
        'sms'                               => 3,
        'country_code'                      => 27,
        'excel_file_name'                   => 'campaigns_'.Illuminate\Support\Str::random(16).'.xlsx',
        'pdf_file_name'                     => 'campaigns_'.Illuminate\Support\Str::random(16).'.pdf',
        'grid_height'                       => 500,
        'grid_page_size'                    => 20,
        'organisation_grid_height'          => 225,
        'organisation_grid_page_size'       => 5,

        'grid_sql'                          => 'SELECT id,campaign_type,campaign_category,created_by_user,name,start_date FROM vw_campaigns',
        'grid_sql_count'                    => 'SELECT COUNT(*) FROM vw_campaigns',

        'grid_model_columns'                =>
        [
            ['name' => 'campaign_type','type' => 'string'],
            ['name' => 'campaign_category','type' => 'string'],
            ['name' => 'created_by_user','type' => 'string'],
            ['name' => 'name','type' => 'string'],
            ['name' => 'start_date','type' => 'string'],
        ],
        'grid_display_columns'              =>
        [
            ['name' => 'id','title' => 'id','hidden' => 'true','filterable' => 'false'],
            ['name' => 'campaign_type','title' => 'campaign.campaign_type','hidden' => 'false','filterable' => 'true'],
            ['name' => 'campaign_category','title' => 'campaign.campaign_category','hidden' => 'false','filterable' => 'true'],
            ['name' => 'name','title' => 'campaign.name','hidden' => 'false','filterable' => 'true'],
            ['name' => 'start_date','title' => 'campaign.start_date','hidden' => 'false','filterable' => 'true'],
        ]
    ];