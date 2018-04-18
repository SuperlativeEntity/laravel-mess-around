<?php

// config('system.min_password_length');
return
[
    'web_version'       => '1.0.0',
    'api_version'       => '1.0.0',

    'url'               => 'https://www.example.com',
    'title'             => 'Mess Around',
    'name'              => 'Mess Around',

    'author'            => 'Superlative',
    'description'       => 'Learning Laravel',
    'keywords'          => 'Default',

    'theme'             => 'default',   // default, color_admin, admin_lte
    'default_namespace' => 'App',
    'session_expiry'    => 30,          // minutes
    'cache_expiry'      => 480,         // minutes
    'idle_increment'    => 60000,       // 1 minute

    // default admin account - created after initial seed
    'admin_first_name'  => 'System',
    'admin_last_name'   => 'App',
    'admin_username'    => 'demo@example.com',
    'admin_password'    => 'Abc123',

    'reply_email'       => 'test@example.com',

    // seeding
    'seed_path'         => database_path().'\seeds',
    'seed_identifier'   => 'TableSeeder',

    'route_path'        => app_path().'/Http/Routes',

    'drop_downs'        =>
    [
        'titles',
        'languages',
        'address_types',
        'provinces',
        'organisation_types',
        'building_types',
        'document_types',
        'nationalities',
        'claim_relationship_types',
        'campaign_categories',
        'campaign_types',
        'districts',
        'choices',
        'note_types',
    ],

    'drop_downs_allowed'    =>
    [
        'CampaignCategory',
        'CampaignType',
        'AddressType',
        'BuildingType',
        'DocumentType',
        'OrganisationType',
        'Province',
        'Role',
        'Title',
        'Language',
        'Nationality',
        'ClaimRelationshipType',
        'District',
        'Choice',
        'NoteType',
    ],

    'persist_user'          => env('PERSIST_USER', false), // acts as a remember me function
    'enable_google_maps'    => env('ENABLE_GOOGLE_MAPS', true),
    'enable_api'            => env('ENABLE_API', true),
    'enable_cdv'            => env('ENABLE_CDV', false),

    'json_request_methods'  => ['POST', 'PUT', 'PATCH'],

    'min_password_length'   => 8,
    'phone_number_length'   => 12,
    'id_number_length'      => 13,

    'valid_mobile_prefixes' => ['071','072','076','079','082','081','060','061','062','063','066','073','078','083','074','084'],

    'excel_file_name'       => 'download_'.Illuminate\Support\Str::random(16).'.xlsx',
    'pdf_file_name'         => 'download_'.Illuminate\Support\Str::random(16).'.pdf',

    'admin_roles'           => [1],
    'individuals_can_login' => false,
];