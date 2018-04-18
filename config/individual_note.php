<?php

// config('individual_note.general')
return
    [
        'general'                       => 1,
        'important'                     => 2,

        'excel_file_name'               => 'individual_notes_'.Illuminate\Support\Str::random(16).'.xlsx',
        'pdf_file_name'                 => 'individual_notes_'.Illuminate\Support\Str::random(16).'.pdf',
        'grid_height'                   => 300,
        'grid_page_size'                => 10,

        'grid_sql'                      => 'SELECT id,note_type,note FROM vw_individual_notes WHERE individual_id = :individual_id',
        'grid_sql_count'                => 'SELECT COUNT(*) FROM vw_individual_notes WHERE individual_id = :individual_id',

        'grid_model_columns'            =>
        [
            ['name' => 'note_type','type' => 'string'],
            ['name' => 'note','type' => 'string']
        ],
        'grid_display_columns'          =>
        [
            ['name' => 'id','title' => 'id','hidden' => 'true','filterable' => 'false'],
            ['name' => 'note_type','title' => 'individual_note.note_type','hidden' => 'false','filterable' => 'true'],
            ['name' => 'note','title' => 'individual_note.note','hidden' => 'false','filterable' => 'true'],
        ],
    ];