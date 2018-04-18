<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualBuildingsPivotTable extends Migration
{
    protected $table = 'individual_buildings';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->integer('individual_id')->unsigned()->index();
                $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('restrict');

                $table->integer('building_id')->unsigned()->index();
                $table->foreign('building_id')->references('id')->on('buildings')->onDelete('restrict');

                $table->primary(['individual_id','building_id'],'individual_buildings_primary');

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
