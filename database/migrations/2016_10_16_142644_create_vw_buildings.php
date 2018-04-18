<?php

use Illuminate\Database\Migrations\Migration;

class CreateVwBuildings extends Migration
{
    protected $table = 'vw_buildings';

    public function up()
    {
        if (!Schema::hasTable($this->table))
        {
            DB::statement('
            CREATE VIEW `vw_buildings` AS
            SELECT
            buildings.id as id,buildings.building_type_id,
            building_types.name AS building_type,
            districts.name AS district,
            buildings.name as building_name,buildings.erf,buildings.valcon_number,
            organisation_buildings.organisation_id,
            organisations.name AS organisation,
            buildings.created_at,buildings.updated_at,buildings.deleted_at,buildings.created_by,buildings.updated_by,created_by.email AS created_by_user,updated_by.email AS updated_by_user
            FROM buildings	
            LEFT JOIN building_types ON buildings.building_type_id = building_types.id
            LEFT JOIN districts ON buildings.district_id = districts.id
            LEFT JOIN organisation_buildings ON buildings.id = organisation_buildings.building_id
            LEFT JOIN organisations ON organisations.id = organisation_buildings.organisation_id
            LEFT JOIN users AS created_by ON buildings.created_by = created_by.id
            LEFT JOIN users AS updated_by ON buildings.updated_by = updated_by.id
            ');
        }
    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            DB::statement('DROP VIEW vw_buildings');
    }
}