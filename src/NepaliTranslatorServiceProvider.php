<?php

namespace Aditya7\NepaliTranslator;

use Illuminate\Support\ServiceProvider;

class NepaliTranslatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish configuration
        $this->publishes([
            __DIR__ . '/../config/nepali_translator.php' => config_path('nepali_translator.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/nepali_translator.php',
            'nepali_translator'
        );

        // Register the NepaliTranslator singleton
        $this->app->singleton('NepaliTranslator', function () {
            return new Translation();
        });
    }
}