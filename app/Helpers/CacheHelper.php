<?php namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class CacheHelper
{
    public static function dropDownCache($key)
    {
        if (!Cache::has($key))
            Cache::add($key,$key::select('id', 'name')->orderBy('name', 'ASC')->get(), config('system.cache_expiry'));

        if (Cache::has($key))
            return Cache::get($key);
    }
}