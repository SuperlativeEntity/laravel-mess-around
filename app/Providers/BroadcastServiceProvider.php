<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        Broadcast::channel('App.User.*', function ($user, $userId)
        {
            return (int) $user->id === (int) $userId;
        });

        Broadcast::channel('organisation.update.*', function ($organisationId)
        {
            return true;
        });

        require base_path('routes/channels.php');
    }
}
