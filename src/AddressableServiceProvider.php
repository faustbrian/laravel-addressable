<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Addressable.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Addressable;

use Artisanry\Countries\CountriesServiceProvider;
use Illuminate\Interfaces\Foundation\Application;
use Illuminate\Support\ServiceProvider;

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

        $this->registerProviders();
    }

    /**
     * Register the third-party service providers.
     */
    private function registerProviders()
    {
        $this->app->register(CountriesServiceProvider::class);
    }
}
