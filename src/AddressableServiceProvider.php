<?php

/*
 * This file is part of Laravel Addressable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Addressable;

use BrianFaust\Countries\CountriesServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Interfaces\Foundation\Application;

class AddressableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/laravel-addressable.php' => config_path('laravel-addressable.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-addressable.php', 'laravel-addressable');

        $this->app->register(CountriesServiceProvider::class);
    }
}
