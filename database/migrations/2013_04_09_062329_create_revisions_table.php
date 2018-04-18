<?php

use Illuminate\Database\Migrations\Migration;

class CreateRevisionTable extends Migration
{
    protected $table = 'revisions';

    public function up()
    {
        echo "migrating {$this->table}\n";

        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function ($table)
            {
                $table->increments('id');

                $table->string('revisionable_type');
                $table->integer('revisionable_id');
                $table->integer('user_id')->nullable();
                $table->string('key');
                $table->text('old_value')->nullable();
                $table->text('new_value')->nullable();
                $table->timestamps();

                $table->index(array('revisionable_id', 'revisionable_type'));

                $table->engine = 'InnoDB';
            });
    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            Schema::drop($this->table);
    }
}
