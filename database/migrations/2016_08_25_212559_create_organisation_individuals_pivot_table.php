<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationIndividualsPivotTable extends Migration
{
    protected $table = 'organisation_individuals';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->integer('organisation_id')->unsigned()->index();
                $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('restrict');

                $table->integer('individual_id')->unsigned()->index();
                $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('restrict');

                $table->integer('role_id')->unsigned()->index();
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');

                $table->primary(['organisation_id','individual_id','role_id'],'organisation_individuals_primary');

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
