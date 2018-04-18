<?php

// config('document.file_extensions_allowed')
return
[
    'file_extensions_allowed'       => ['.gif','.jpg', '.png', '.pdf', '.doc', '.docx','.xlsx','.xls'],
    'excel_file_name'               => 'documents_'.Illuminate\Support\Str::random(16).'.xlsx',
    'pdf_file_name'                 => 'documents_'.Illuminate\Support\Str::random(16).'.pdf',
    'grid_height'                   => 300,
    'grid_page_size'                => 10,

    'grid_sql'                      => 'SELECT id,document_type,document_name,document_size,document_extension FROM vw_documents WHERE organisation_id = :organisation_id',
    'grid_sql_count'                => 'SELECT COUNT(*) FROM vw_documents WHERE organisation_id = :organisation_id',

    'grid_model_columns'            =>
    [
        ['name' => 'document_type','type' => 'string'],
        ['name' => 'document_name','type' => 'string'],
        ['name' => 'document_size','type' => 'string'],
        ['name' => 'document_extension','type' => 'string'],
    ],
    'grid_display_columns'          =>
    [
        ['name' => 'id','title' => 'id','hidden' => 'true','filterable' => 'false'],
        ['name' => 'document_type','title' => 'document.document_type','hidden' => 'false','filterable' => 'true'],
        ['name' => 'document_name','title' => 'document.name','hidden' => 'false','filterable' => 'true'],
        ['name' => 'document_size','title' => 'document.size','hidden' => 'false','filterable' => 'true'],
        ['name' => 'document_extension','title' => 'document.extension','hidden' => 'false','filterable' => 'true'],
    ],
];