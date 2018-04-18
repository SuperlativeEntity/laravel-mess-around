<?php

use Illuminate\Database\Migrations\Migration;

class CreateVwIndividuals extends Migration
{
    protected $table = 'vw_individuals';

    public function up()
    {
        if (!Schema::hasTable($this->table))
        {
            DB::statement('
            CREATE VIEW `vw_individuals` AS
            SELECT individuals.id,user_id,title_id,language_id,
            titles.name as title,languages.name as language,
            individuals.first_name,individuals.last_name,individuals.id_number,
            individuals.email,individuals.mobile,individuals.home,individuals.work,individuals.fax,
            individuals.created_at,individuals.updated_at,individuals.deleted_at,
            created_by.email AS created_by_user,
            updated_by.email AS updated_by_user
            FROM individuals
            LEFT JOIN titles ON titles.id = individuals.title_id
            LEFT JOIN languages ON languages.id = individuals.language_id
            LEFT JOIN users AS created_by ON individuals.created_by = created_by.id
            LEFT JOIN users AS updated_by ON individuals.updated_by = updated_by.id
            ');
        }
    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            DB::statement('DROP VIEW vw_individuals');
    }
}