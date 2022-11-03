<?php

namespace BrandStudio\Starter;

use Illuminate\Support\ServiceProvider;
use BrandStudio\Starter\Console\Commands\CreateController;
use BrandStudio\Starter\Console\Commands\CreateModel;

class StarterServiceProvider extends ServiceProvider
{

    protected $commands = [
        CreateController::class,
        CreateModel::class,
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/starter.php', 'starter');
        $this->commands($this->commands);

        if ($this->app->runningInConsole()) {
            $this->publish();
        }

    }

    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'starter');

        if ($this->app->runningInConsole()) {
            $this->publish();
        }
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/config/starter.php' => config_path('starter.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/starter')
        ], 'lang');

        // $this->publishes([
        //     __DIR__.'/resources/lang' => resource_path('lang/vendor/page')
        // ], 'lang');


    }

}
