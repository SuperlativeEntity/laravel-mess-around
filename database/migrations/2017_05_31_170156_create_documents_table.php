<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    protected $table = 'documents';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->increments('id');

                $table->integer('document_type_id')->unsigned()->index();
                $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('restrict');

                $table->string('name');
                $table->decimal('size',5,2);
                $table->string('mime_type');
                $table->string('extension',10);
                $table->string('storage_path');

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
