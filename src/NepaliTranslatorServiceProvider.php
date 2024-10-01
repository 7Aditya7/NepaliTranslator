<?php

namespace 7aditya7\nepali-translator;

use Illuminate\Support\ServiceProvider;

class nepali-translatorServiceProvider extends ServiceProvider
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

        $this->app->singleton('nepali-translator', function () {
            return new Translation();
        });
    }
}