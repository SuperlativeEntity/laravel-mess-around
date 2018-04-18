<?php

use Illuminate\Database\Migrations\Migration;

class CreateVwIndividualBuildings extends Migration
{
    protected $table = 'vw_individual_buildings';

    public function up()
    {
        if (!Schema::hasTable($this->table))
        {
            DB::statement('
            CREATE VIEW `vw_individual_buildings` AS
            SELECT
            organisation_buildings.organisation_id,
            individual_buildings.individual_id,
            individual_buildings.building_id,
            organisations.name AS organisation,
            buildings.name AS building,
            individuals.first_name,individuals.last_name,individuals.id_number,
            individuals.email,individuals.mobile,individuals.home,individuals.work,individuals.fax,
            individuals.created_at,individuals.updated_at,individuals.deleted_at,
            created_by.email AS created_by_user,
            updated_by.email AS updated_by_user,
            user_id,title_id,language_id,
            titles.name as title,
            languages.name as language
            FROM individual_buildings
            JOIN organisation_buildings ON organisation_buildings.building_id = individual_buildings.building_id
            JOIN individuals ON individuals.id = individual_buildings.individual_id
            JOIN buildings ON buildings.id = individual_buildings.building_id
            JOIN organisations ON organisations.id = organisation_buildings.organisation_id
            JOIN titles ON titles.id = individuals.title_id
            JOIN languages ON languages.id = individuals.language_id
            LEFT JOIN users AS created_by ON individuals.created_by = created_by.id
            LEFT JOIN users AS updated_by ON individuals.updated_by = updated_by.id
            ');
        }
    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            DB::statement('DROP VIEW vw_individual_buildings');
    }
}