<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationsTable extends Migration
{
    protected $table = 'organisations';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->increments('id');

                $table->integer('organisation_type_id')->unsigned()->index();
                $table->foreign('organisation_type_id')->references('id')->on('organisation_types')->onDelete('restrict');

                $table->string('name')->unique();
                $table->string('trading_as')->nullable();
                $table->string('registration_number')->nullable(); // e.g. Company Registration Number, Sectional Title Registration Number

                $table->string('phone',config('system.phone_number_length'))->nullable();
                $table->string('fax',config('system.phone_number_length'))->nullable();
                $table->string('email',254)->nullable();
                $table->string('url',253)->nullable();

                $table->string('deed')->nullable();

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
