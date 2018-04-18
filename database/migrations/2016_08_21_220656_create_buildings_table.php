<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    protected $table = 'buildings';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->increments('id');

                $table->integer('province_id')->unsigned()->nullable();
                $table->foreign('province_id')->references('id')->on('provinces')->onDelete('restrict');

                $table->integer('district_id')->unsigned()->index();
                $table->foreign('district_id')->references('id')->on('districts')->onDelete('restrict');

                $table->integer('building_type_id')->unsigned()->nullable();
                $table->foreign('building_type_id')->references('id')->on('building_types')->onDelete('restrict');

                $table->string('name')->unique();
                $table->string('erf')->unique();
                $table->text('address')->nullable();

                $table->double('valuation_amount',15,2)->default(0);

                $table->integer('valcon_registered_id')->unsigned()->index();
                $table->foreign('valcon_registered_id')->references('id')->on('choices')->onDelete('restrict');

                $table->string('valcon_number')->nullable();

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
        if (!Schema::hasTable($this->table))
            Schema::drop($this->table);
    }
}
