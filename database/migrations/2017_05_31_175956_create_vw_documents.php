<?php

use Illuminate\Database\Migrations\Migration;

class CreateVwDocuments extends Migration
{
    protected $table = 'vw_documents';

    public function up()
    {
        if (!Schema::hasTable($this->table))
        {
            DB::statement('
            CREATE VIEW `vw_documents` AS
            SELECT
            documents.id as id,documents.document_type_id,document_types.name AS document_type,
            documents.name as document_name,documents.size as document_size,documents.extension as document_extension,
            organisation_documents.organisation_id,
            organisations.name AS organisation,
            documents.created_at,documents.updated_at,documents.deleted_at,documents.created_by,documents.updated_by,created_by.email AS created_by_user,updated_by.email AS updated_by_user
            FROM documents	
            LEFT JOIN document_types ON documents.document_type_id= document_types .id
            LEFT JOIN organisation_documents ON documents.id = organisation_documents.document_id
            LEFT JOIN organisations ON organisations.id = organisation_documents.organisation_id
            LEFT JOIN users AS created_by ON documents.created_by = created_by.id
            LEFT JOIN users AS updated_by ON documents.updated_by = updated_by.id
            ');
        }
    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            DB::statement('DROP VIEW vw_documents');
    }
}