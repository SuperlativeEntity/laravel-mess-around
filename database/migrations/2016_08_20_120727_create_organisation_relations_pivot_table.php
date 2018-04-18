<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationRelationsPivotTable extends Migration
{
    protected $table = 'organisation_relations';

    // to be able to link organisations to each other
    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->integer('parent_id')->unsigned()->index();
                $table->foreign('parent_id')->references('id')->on('organisations')->onDelete('restrict');

                $table->integer('child_id')->unsigned()->index();
                $table->foreign('child_id')->references('id')->on('organisations')->onDelete('restrict');

                $table->primary(['parent_id','child_id'],'organisation_relations_primary');

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

