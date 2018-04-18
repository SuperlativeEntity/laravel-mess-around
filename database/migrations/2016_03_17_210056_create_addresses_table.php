<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    protected $table = 'addresses';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->increments('id');

                $table->integer('address_type_id')->unsigned()->index();    // physical address
                $table->foreign('address_type_id')->references('id')->on('address_types');

                $table->string('street_postbox'); // street / (p.o box, postnet suite, private bag): e.g. 18 redruth street
                $table->string('additional')->nullable(); // additional: e.g uit 'n tuis

                $table->string('suburb')->nullable(); // new redruth
                $table->string('town')->nullable(); // alberton
                $table->string('city')->nullable(); // johannesburg

                $table->integer('province_id')->unsigned()->index(); // gauteng
                $table->foreign('province_id')->references('id')->on('provinces');

                $table->string('postal_code',4); // postal codes can start with zero

                $table->string('unique_key');

                $table->unique(['unique_key','address_type_id'], 'addresses_unique');

                $table->integer('created_by')->unsigned()->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

                $table->integer('updated_by')->unsigned()->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

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
