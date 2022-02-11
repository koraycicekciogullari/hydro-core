<?php

namespace Koraycicekciogullari\HydroCore;


use Koraycicekciogullari\HydroCore\Commands\HydroInstall;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/hydro-core.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('hydro-core.php'),
        ], 'config');
        $this->loadRoutesFrom(__DIR__ . '/Routes/core-route.php');
        if ($this->app->runningInConsole()) {
            $this->commands([
                HydroInstall::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'hydro-core'
        );
    }
}
