<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use File;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    private $service = 'breadcrumbs';

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
