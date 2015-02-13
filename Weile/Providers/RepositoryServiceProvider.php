<?php

namespace Weile\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Weile\Repositories\MemberRepositoryInterface',
            'Weile\Repositories\Eloquent\MemberRepository'
        );

    }
}
