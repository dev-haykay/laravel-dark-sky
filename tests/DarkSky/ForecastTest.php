<?php

namespace Illuminated\DarkSky\Tests;

use Illuminated\DarkSky\DarkSky;

class ForecastTest extends TestCase
{
    /** @test */
    public function it_allows_to_request_the_forecast_for_a_given_location()
    {
        $forecast = (new DarkSky(46.4825, 30.7233))->forecast();

        $this->assertArrayHasKey('currently', $forecast);
        $this->assertArrayHasKey('hourly', $forecast);
        $this->assertArrayHasKey('daily', $forecast);
        $this->assertArrayHasKey('flags', $forecast);
    }

    /** @test */
    public function you_can_specify_desired_response_block_as_a_string()
    {
        $forecast = (new DarkSky(46.4825, 30.7233))->forecast('daily');

        $this->assertArrayHasKey('daily', $forecast);
        $this->assertArrayNotHasKey('currently', $forecast);
        $this->assertArrayNotHasKey('hourly', $forecast);
        $this->assertArrayNotHasKey('flags', $forecast);
    }

    /** @test */
    public function you_can_specify_desired_response_blocks_as_an_array()
    {
        $forecast = (new DarkSky(46.4825, 30.7233))->forecast(['daily', 'flags']);

        $this->assertArrayHasKey('daily', $forecast);
        $this->assertArrayHasKey('flags', $forecast);
        $this->assertArrayNotHasKey('currently', $forecast);
        $this->assertArrayNotHasKey('hourly', $forecast);
    }

    /** @test */
    public function if_the_gibberish_passed_you_will_get_all_blocks()
    {
        $forecast = (new DarkSky(46.4825, 30.7233))->forecast('pencil');

        $this->assertArrayHasKey('currently', $forecast);
        $this->assertArrayHasKey('hourly', $forecast);
        $this->assertArrayHasKey('daily', $forecast);
        $this->assertArrayHasKey('flags', $forecast);
    }
}
