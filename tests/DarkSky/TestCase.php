<?php

namespace Illuminated\DarkSky\Tests;

use Illuminated\DarkSky\ServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function resolveApplicationConfiguration($app)
    {
        $fixturePath = __DIR__ . '/fixture/config/dark-sky.php';
        $orchestraPath = $this->getBasePath() . '/config/dark-sky.php';
        copy($fixturePath, $orchestraPath);

        parent::resolveApplicationConfiguration($app);

        unlink($orchestraPath);
    }
}
