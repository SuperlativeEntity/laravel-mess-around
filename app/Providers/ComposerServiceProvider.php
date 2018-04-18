<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*','App\Http\ViewComposers\UserComposer');
        view()->composer('*','App\Http\ViewComposers\IndividualComposer');
    }

    public function register()
    {
    }
}
