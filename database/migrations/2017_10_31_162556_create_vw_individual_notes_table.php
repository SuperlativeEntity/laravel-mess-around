<?php

use Illuminate\Database\Migrations\Migration;

class CreateVwIndividualNotesTable extends Migration
{
    protected $table = 'vw_individual_notes';

    public function up()
    {
        if (!Schema::hasTable($this->table))
        {
            DB::statement('
            CREATE VIEW `vw_individual_notes` AS
            SELECT
            notes.id as id,notes.note_type_id,note_types.name AS note_type,notes.note,
            individual_notes.individual_id,
            individuals.first_name AS first_name,
            individuals.last_name AS last_name,
            notes.created_at,notes.updated_at,notes.deleted_at,
            notes.created_by,notes.updated_by,
            created_by.email AS created_by_user,
            updated_by.email AS updated_by_user
            FROM notes
            LEFT JOIN note_types ON notes.note_type_id= note_types .id
            LEFT JOIN individual_notes ON notes.id = individual_notes.note_id
            LEFT JOIN individuals ON individuals.id = individual_notes.individual_id
            LEFT JOIN users AS created_by ON notes.created_by = created_by.id
            LEFT JOIN users AS updated_by ON notes.updated_by = updated_by.id
            ');
        }
    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            DB::statement('DROP VIEW vw_individual_notes');
    }
}