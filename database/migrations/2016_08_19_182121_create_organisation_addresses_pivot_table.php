<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationAddressesPivotTable extends Migration
{
    protected $table = 'organisation_addresses';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->integer('organisation_id')->unsigned()->index();
                $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('restrict');

                $table->integer('address_id')->unsigned()->index();
                $table->foreign('address_id')->references('id')->on('addresses')->onDelete('restrict');

                $table->primary(['organisation_id','address_id'],'organisation_addresses_primary');

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
