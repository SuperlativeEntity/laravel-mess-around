<?php

// config('individual.grid_sql_organisation_fields')
return
[
    'excel_file_name'                   => 'individuals_'.Illuminate\Support\Str::random(16).'.xlsx',
    'pdf_file_name'                     => 'individuals_'.Illuminate\Support\Str::random(16).'.pdf',
    'grid_height'                       => 500,
    'grid_page_size'                    => 20,
    'organisation_grid_height'          => 225,
    'organisation_grid_page_size'       => 5,

    'grid_sql'                          => 'SELECT id,first_name,last_name,id_number,email,mobile FROM vw_individuals',
    'grid_sql_count'                    => 'SELECT COUNT(*) FROM vw_individuals',

    'grid_sql_by_organisation'          => 'SELECT individual_id as id,first_name,last_name,id_number,email,mobile FROM vw_organisation_individuals_distinct WHERE organisation_id = :organisation_id',
    'grid_sql_by_organisation_count'    => 'SELECT COUNT(*) FROM vw_organisation_individuals_distinct WHERE organisation_id = :organisation_id',

    'grid_sql_organisations'            => 'SELECT organisation_id,organisation_type,organisation_type_id,organisation,organisation_registration_number FROM vw_organisation_individuals_distinct WHERE individual_id = :individual_id',
    'grid_sql_organisations_count'      => 'SELECT COUNT(*) FROM vw_organisation_individuals_distinct WHERE individual_id = :individual_id',
    'grid_sql_organisation_fields'      => ['organisation','organisation_type','organisation_registration_number'],

    'grid_model_columns'                =>
    [
        ['name' => 'id','type' => 'string'],
        ['name' => 'first_name','type' => 'string'],
        ['name' => 'last_name','type' => 'string'],
        ['name' => 'id_number','type' => 'string'],
        ['name' => 'email','type' => 'string'],
        ['name' => 'mobile','type' => 'string'],
    ],
    'grid_display_columns'              =>
    [
        ['name' => 'id','title' => 'individual.id','hidden' => 'false','filterable' => 'true'],
        ['name' => 'first_name','title' => 'individual.first_name','hidden' => 'false','filterable' => 'true'],
        ['name' => 'last_name','title' => 'individual.last_name','hidden' => 'false','filterable' => 'true'],
        ['name' => 'id_number','title' => 'individual.id_number','hidden' => 'false','filterable' => 'true'],
        ['name' => 'email','title' => 'individual.email','hidden' => 'false','filterable' => 'true'],
        ['name' => 'mobile','title' => 'individual.mobile','hidden' => 'false','filterable' => 'true'],
    ]
];