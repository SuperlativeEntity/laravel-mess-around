<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationDocumentsPivotTable extends Migration
{
    protected $table = 'organisation_documents';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->integer('organisation_id')->unsigned()->index();
                $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('restrict');

                $table->integer('document_id')->unsigned()->index();
                $table->foreign('document_id')->references('id')->on('documents')->onDelete('restrict');

                $table->primary(['organisation_id','document_id'],'organisation_documents_primary');

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
