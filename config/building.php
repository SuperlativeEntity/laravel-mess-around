<?php

// config('building.stand')
return
[
    'unit'                          => 1,
    'stand'                         => 2,
    'lodge'                         => 3,

    'excel_file_name'               => 'buildings_'.Illuminate\Support\Str::random(16).'.xlsx',
    'pdf_file_name'                 => 'buildings_'.Illuminate\Support\Str::random(16).'.pdf',
    'grid_height'                   => 300,
    'grid_page_size'                => 10,

    'grid_sql'                      => 'SELECT id,district,building_name,erf FROM vw_buildings WHERE organisation_id = :organisation_id',
    'grid_sql_count'                => 'SELECT COUNT(*) FROM vw_buildings WHERE organisation_id = :organisation_id',

    'grid_model_columns'            =>
    [
        ['name' => 'district','type' => 'string'],
        ['name' => 'building_name','type' => 'string'],
        ['name' => 'erf','type' => 'string'],
    ],
    'grid_display_columns'          =>
    [
        ['name' => 'id','title' => 'id','hidden' => 'true','filterable' => 'false'],
        ['name' => 'district','title' => 'building.district','hidden' => 'false','filterable' => 'true'],
        ['name' => 'building_name','title' => 'building.name','hidden' => 'false','filterable' => 'true'],
        ['name' => 'erf','title' => 'building.erf','hidden' => 'false','filterable' => 'true'],
    ],
];