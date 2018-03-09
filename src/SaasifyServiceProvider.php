<?php

namespace Dialect\Saasify;

use Illuminate\Support\ServiceProvider;

class SaasifyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->loadMigrationsFrom(__DIR__ . '/../migrations');


    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
	    $this->app->bind('saasify', Saasify::class);
    }
}