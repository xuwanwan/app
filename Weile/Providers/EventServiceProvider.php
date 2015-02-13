<?php

namespace Weile\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['events']->listen('auth.login', 'Weile\Events\LoginHandler');
        $this->app['events']->listen('auth.logout', 'Weile\Events\LogoutHandler');
    }

    public function register()
    {

    }
}
