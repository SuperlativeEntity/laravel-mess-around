<?php

use Illuminate\Database\Migrations\Migration;

class CreateVwOrganisationIndividualsDistinct extends Migration
{
    protected $table = 'vw_organisation_individuals_distinct';

    public function up()
    {
        if (!Schema::hasTable($this->table))
        {
            DB::statement('
            CREATE VIEW `vw_organisation_individuals_distinct` AS
            SELECT DISTINCT
            organisation_individuals.organisation_id,
            organisation_individuals.individual_id,
            organisations.name AS organisation,
            individuals.first_name,individuals.last_name,individuals.id_number,
            individuals.email,individuals.mobile,individuals.home,individuals.work,individuals.fax,
            individuals.created_at,individuals.updated_at,individuals.deleted_at,
            created_by.email AS created_by_user,
            updated_by.email AS updated_by_user,
            user_id,title_id,language_id,
            titles.name as title,
            languages.name as language,
            organisation_types.name AS organisation_type,
            organisations.organisation_type_id,
            organisations.registration_number AS organisation_registration_number,
            organisations.phone AS organisation_phone,
            organisations.fax AS organisation_fax,
            organisations.email AS organisation_email
            FROM individuals
            LEFT JOIN titles ON titles.id = individuals.title_id
            LEFT JOIN languages ON languages.id = individuals.language_id
            LEFT JOIN users AS created_by ON individuals.created_by = created_by.id
            LEFT JOIN users AS updated_by ON individuals.updated_by = updated_by.id
            LEFT JOIN organisation_individuals ON individuals.id = organisation_individuals.individual_id
            LEFT JOIN organisations ON organisations.id = organisation_individuals.organisation_id
            LEFT JOIN organisation_types ON organisation_types.id = organisations.organisation_type_id
            ');
        }
    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            DB::statement('DROP VIEW vw_organisation_individuals_distinct');
    }
}