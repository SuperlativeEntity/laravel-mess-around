<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualAddressesPivotTable extends Migration
{
    protected $table = 'individual_addresses';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->integer('individual_id')->unsigned()->index();
                $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('restrict');

                $table->integer('address_id')->unsigned()->index();
                $table->foreign('address_id')->references('id')->on('addresses')->onDelete('restrict');

                $table->primary(['individual_id','address_id'],'individual_addresses_primary');

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
