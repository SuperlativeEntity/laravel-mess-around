<?php

use App\Helpers\GeneralHelper;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropDownTable extends Migration
{
    public function up()
    {
        if (GeneralHelper::isArrayWithValues(config('system.drop_downs')))
        {
            foreach (config('system.drop_downs') as $drop_down)
            {
                if (!Schema::hasTable($drop_down))
                    Schema::create($drop_down, function (Blueprint $table)
                    {
                        $table->increments('id');
                        $table->string('name')->unique();
                        $table->timestamps();
                        $table->softDeletes();

                        $table->engine = 'InnoDB';
                    });
            }
        }
    }

    public function down()
    {
        if (GeneralHelper::isArrayWithValues(config('system.drop_downs')))
        {
            foreach (config('system.drop_downs') as $drop_down)
            {
                if (Schema::hasTable($drop_down))
                    Schema::drop($drop_down);
            }
        }
    }
}
