<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    protected $table = 'campaigns';

    public function up()
    {
        if (!Schema::hasTable($this->table))
            Schema::create($this->table, function (Blueprint $table)
            {
                $table->increments('id');

                // email or sms
                $table->integer('campaign_type_id')->unsigned()->index();
                $table->foreign('campaign_type_id')->references('id')->on('campaign_types')->onDelete('restrict');

                // marketing
                $table->integer('campaign_category_id')->unsigned()->index();
                $table->foreign('campaign_category_id')->references('id')->on('campaign_categories')->onDelete('restrict');

                $table->string('name')->unique();

                $table->longText('message')->nullable();
                $table->longText('contacts')->nullable();
                $table->integer('contacts_count')->unsigned()->default(0);

                $table->date('start_date');

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
