<?php

use Illuminate\Database\Migrations\Migration;

class CreateVwOrganisationIndividualsWithRole extends Migration
{
    protected $table = 'vw_organisation_individuals_with_role';

    public function up()
    {
        if (!Schema::hasTable($this->table))
        {
            DB::statement('
            CREATE VIEW `vw_organisation_individuals_with_role` AS
            SELECT 
            organisation_individuals.organisation_id,
            organisation_individuals.individual_id,
            organisation_individuals.role_id,
            organisations.name AS organisation,
            roles.name as role,
            individuals.first_name,individuals.last_name,individuals.id_number,
            individuals.email,individuals.mobile,individuals.home,individuals.work,individuals.fax,
            individuals.created_at,individuals.updated_at,individuals.deleted_at,
            created_by.email AS created_by_user,
            updated_by.email AS updated_by_user,
            user_id,title_id,language_id,
            titles.name as title,
            languages.name as language
            FROM individuals
            LEFT JOIN titles ON titles.id = individuals.title_id
            LEFT JOIN languages ON languages.id = individuals.language_id
            LEFT JOIN users AS created_by ON individuals.created_by = created_by.id
            LEFT JOIN users AS updated_by ON individuals.updated_by = updated_by.id
            LEFT JOIN organisation_individuals ON individuals.id = organisation_individuals.individual_id
            LEFT JOIN roles ON roles.id = organisation_individuals.role_id
            LEFT JOIN organisations ON organisations.id = organisation_individuals.organisation_id
            ');
        }
    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            DB::statement('DROP VIEW vw_organisation_individuals_with_role');
    }
}