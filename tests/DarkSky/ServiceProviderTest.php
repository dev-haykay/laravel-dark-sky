<?php

namespace Illuminated\DarkSky\Tests;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function it_merges_default_configuration_with_published_one()
    {
        $this->assertEquals([
            'key' => '43e427ceb504ec730f9cc258bab1a81d',
            'extend' => 'hourly',
            'lang' => 'ru',
            'units' => 'si',
        ], config('dark-sky'));
    }
}
