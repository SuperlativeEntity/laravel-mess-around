<?php

use Illuminate\Database\Migrations\Migration;

class CreateVwOrganisations extends Migration
{
    protected $table = 'vw_organisations';

    public function up()
    {
        if (!Schema::hasTable($this->table))
        {
            DB::statement('CREATE VIEW `vw_organisations` AS
            SELECT organisation_types.name AS organisation_type,
            organisations.id,organisations.name,organisations.trading_as,organisations.registration_number,
            organisations.phone,organisations.fax,organisations.email,organisations.url,organisations.deed
            FROM organisations 
            LEFT JOIN organisation_types ON organisation_types.id = organisations.organisation_type_id');
        }

    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            DB::statement('DROP VIEW vw_organisations');
    }
}
