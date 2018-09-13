<?php

namespace Illuminated\DarkSky;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom($this->getConfigPath(), 'dark-sky');
    }

    public function boot()
    {
        $this->publishes([
            $this->getConfigPath() => config_path('dark-sky.php'),
        ], 'config');
    }

    protected function getConfigPath()
    {
        return __DIR__ . '/../config/dark-sky.php';
    }
}
