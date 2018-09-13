<?php

namespace Illuminated\DarkSky\Tests;

use Illuminated\DarkSky\ServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}
