<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    protected $table = 'notes';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->increments('id');

                $table->integer('note_type_id')->unsigned()->index();
                $table->foreign('note_type_id')->references('id')->on('note_types')->onDelete('restrict');

                $table->text('note');

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
