<?php

// config('organisation.private_individual')
return
[
    'company'               => 1,
    'trust'                 => 2,
    'private_individual'    => 3,

    'grid_height'           => 500,

    'grid_columns'          =>
    [
        'id',
        'organisation_type',
        'name',
        'registration_number',
        'deed',
    ],

    'grid_sql'               => 'SELECT organisation_type,id,name,trading_as,registration_number,phone,fax,email,url,deed FROM vw_organisations',

    // buildings can only be captured under these organisation types directly
    'has_buildings'          =>
    [
        1, // company
        2, // trust
        3, // individuals
    ],
];