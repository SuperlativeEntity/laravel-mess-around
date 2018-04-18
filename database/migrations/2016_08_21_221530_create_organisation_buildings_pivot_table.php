<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationBuildingsPivotTable extends Migration
{
    protected $table = 'organisation_buildings';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->integer('organisation_id')->unsigned()->index();
                $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('restrict');

                $table->integer('building_id')->unsigned()->index();
                $table->foreign('building_id')->references('id')->on('buildings')->onDelete('restrict');

                $table->primary(['organisation_id','building_id'],'organisation_buildings_primary');

                $table->timestamps();
                $table->softDeletes();

                $table->engine = 'InnoDB';
            });
    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            Schema::drop($this->table);
    }
}
