<?php

namespace Titeca\Sybase;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['db']->extend('sybase', function($config, $connection) {
            return new Connection(
                (new Connector)->connect($config),
                $config['database'], 
                $config['prefix'] ?: '', 
                $config
            );   
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}