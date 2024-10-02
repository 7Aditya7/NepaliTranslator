<?php

namespace Aditya7\NepaliTranslator;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class NepaliTranslatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Merge package configuration with the application's copy
        $this->mergeConfigFrom(__DIR__ . '/../config/nepalitranslator.php', 'nepalitranslator');

        // Bind the Translation class to the service container
        $this->app->singleton('nepalitranslator', function ($app) {
            return new Translation(new Client());
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/nepalitranslator.php' => config_path('nepalitranslator.php'),
        ], 'config');
    }
}
