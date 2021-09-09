<?php

namespace Indeximstudio\LaravelTelegramMessages;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/laravel-telegram-messages.php';
        $this->mergeConfigFrom($configPath, 'laravel-telegram-messages');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'telegram-messages');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-telegram-messages.php' => config_path('laravel-telegram-messages.php'),
        ], 'laravel-telegram-messages-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/telegram-messages'),
        ], 'laravel-telegram-messages-views');
    }
}
