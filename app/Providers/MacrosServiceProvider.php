<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use File;

class MacrosServiceProvider extends ServiceProvider
{

    private $service = 'macros';

    public function boot()
    {
        $path = base_path() . '/resources/'.$this->service;

        foreach (File::allFiles($path) as $file)
        {
            require($file->getPathname());
        }
    }

    public function register()
    {

    }
}
