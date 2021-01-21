<?php

namespace Emodyz\Flash;

use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'emodyz');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'emodyz');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        // $this->mergeConfigFrom(__DIR__.'/../config/flash.php', 'flash');

        $this->app->bind(
            'Emodyz\Flash\SessionStore',
            'Emodyz\Flash\LaravelSessionStore'
        );

        // Register the service the package provides.
        $this->app->singleton('flash', function ($app) {
            return $app->make('Emodyz\Flash\FlashNotifier');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['flash'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/flash.php' => config_path('flash.php'),
        ], 'flash.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/emodyz'),
        ], 'flash.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/emodyz'),
        ], 'flash.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/emodyz'),
        ], 'flash.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
