<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualsTable extends Migration
{
    protected $table = 'individuals';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->increments('id');

                // each individual has the potential to login
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');

                // for official documents
                $table->integer('title_id')->unsigned()->nullable();
                $table->foreign('title_id')->references('id')->on('titles')->onDelete('restrict');

                // for communication preference
                $table->integer('language_id')->unsigned()->index();
                $table->foreign('language_id')->references('id')->on('languages')->onDelete('restrict');

                $table->integer('nationality_id')->unsigned()->index();
                $table->foreign('nationality_id')->references('id')->on('nationalities')->onDelete('restrict');

                $table->string('initials',10)->nullable();
                $table->string('first_name');
                $table->string('last_name');

                $table->string('id_number')->nullable();
                $table->date('birth_date')->nullable();
                $table->date('join_date')->nullable();

                $table->string('mobile',config('system.phone_number_length'))->nullable();
                $table->string('mobile_secondary',config('system.phone_number_length'))->nullable();
                $table->string('home',config('system.phone_number_length'))->nullable();
                $table->string('work',config('system.phone_number_length'))->nullable();
                $table->string('email',254)->unique();
                $table->string('email_secondary',254)->nullable();
                $table->string('fax',config('system.phone_number_length'))->nullable();

                $table->integer('communication')->unsigned()->nullable();
                $table->foreign('communication')->references('id')->on('choices')->onDelete('restrict');

                $table->integer('newsletter')->unsigned()->nullable();
                $table->foreign('newsletter')->references('id')->on('choices')->onDelete('restrict');

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
