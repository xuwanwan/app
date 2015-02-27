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
        $this->app->bind(
            'Weile\Repositories\BaseDataRepositoryInterface',
            'Weile\Repositories\Eloquent\BaseDataRepository'
        );
        $this->app->bind(
            'Weile\Repositories\ProductRepositoryInterface',
            'Weile\Repositories\Eloquent\ProductRepository'
        );

    }
}
