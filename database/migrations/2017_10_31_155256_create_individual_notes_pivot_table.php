<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualNotesPivotTable extends Migration
{
    protected $table = 'individual_notes';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->integer('individual_id')->unsigned()->index();
                $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('restrict');

                $table->integer('note_id')->unsigned()->index();
                $table->foreign('note_id')->references('id')->on('notes')->onDelete('restrict');

                $table->primary(['individual_id','note_id'],'individual_notes_primary');

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
