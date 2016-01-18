<?php

namespace DraperStudio\Addressable;

use DraperStudio\ServiceProvider\ServiceProvider as BaseProvider;
use DraperStudio\Countries\ServiceProvider as CountriesServiceProvider;

class ServiceProvider extends BaseProvider
{
    protected $packageName = 'addressable';

    public function boot()
    {
        $this->setup(__DIR__)
             ->publishMigrations()
             ->publishConfig()
             ->mergeConfig('addressable');
    }

    public function register()
    {
        $this->app->register(CountriesServiceProvider::class);
    }

    public function provides()
    {
        return [CountriesServiceProvider::class];
    }
}
