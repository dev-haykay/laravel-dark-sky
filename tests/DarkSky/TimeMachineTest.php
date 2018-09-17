<?php

namespace Illuminated\DarkSky\Tests;

use Illuminated\DarkSky\DarkSky;

class TimeMachineTest extends TestCase
{
    /** @test */
    public function it_allows_to_request_weather_for_a_given_location_and_time_as_unix_timestamp()
    {
        $weather = (new DarkSky(46.4825, 30.7233))->timeMachine(strtotime('1986-05-11'));

        $this->assertArrayHasKey('currently', $weather);
        $this->assertArrayHasKey('hourly', $weather);
        $this->assertArrayHasKey('daily', $weather);
        $this->assertArrayHasKey('flags', $weather);
    }

    /** @test */
    public function time_can_be_a_date_string_as_well()
    {
        $weather = (new DarkSky(46.4825, 30.7233))->timeMachine('1986-05-11');

        $this->assertArrayHasKey('currently', $weather);
        $this->assertArrayHasKey('hourly', $weather);
        $this->assertArrayHasKey('daily', $weather);
        $this->assertArrayHasKey('flags', $weather);
    }

    /** @test */
    public function time_can_be_a_datetime_string_as_well()
    {
        $weather = (new DarkSky(46.4825, 30.7233))->timeMachine('1986-05-11 15:30:00');

        $this->assertArrayHasKey('currently', $weather);
        $this->assertArrayHasKey('hourly', $weather);
        $this->assertArrayHasKey('daily', $weather);
        $this->assertArrayHasKey('flags', $weather);
    }

    /** @test */
    public function time_can_be_string_as_well()
    {
        $weather = (new DarkSky(46.4825, 30.7233))->timeMachine('previous Monday');

        $this->assertArrayHasKey('currently', $weather);
        $this->assertArrayHasKey('hourly', $weather);
        $this->assertArrayHasKey('daily', $weather);
        $this->assertArrayHasKey('flags', $weather);
    }

    /** @test */
    public function you_can_specify_desired_response_block_as_a_string()
    {
        $weather = (new DarkSky(46.4825, 30.7233))->timeMachine('1986-05-11', 'daily');

        $this->assertArrayHasKey('daily', $weather);
        $this->assertArrayNotHasKey('currently', $weather);
        $this->assertArrayNotHasKey('hourly', $weather);
        $this->assertArrayNotHasKey('flags', $weather);
    }

    /** @test */
    public function you_can_specify_desired_response_blocks_as_an_array()
    {
        $weather = (new DarkSky(46.4825, 30.7233))->timeMachine('1986-05-11', ['daily', 'flags']);

        $this->assertArrayHasKey('daily', $weather);
        $this->assertArrayHasKey('flags', $weather);
        $this->assertArrayNotHasKey('currently', $weather);
        $this->assertArrayNotHasKey('hourly', $weather);
    }

    /** @test */
    public function you_can_pass_an_array_of_dates_for_time_machine_requests()
    {
        $weather = (new DarkSky(46.4825, 30.7233))->timeMachine(['1986-05-11', '1987-05-11', '1988-05-11']);

        $this->assertCount(3, $weather);

        $this->assertArrayHasKey('1986-05-11', $weather);
        $this->assertArrayHasKey('1987-05-11', $weather);
        $this->assertArrayHasKey('1988-05-11', $weather);

        $this->assertArrayHasKey('currently', $weather['1986-05-11']);
        $this->assertArrayHasKey('hourly', $weather['1986-05-11']);
        $this->assertArrayHasKey('daily', $weather['1986-05-11']);
        $this->assertArrayHasKey('flags', $weather['1986-05-11']);

        $this->assertArrayHasKey('currently', $weather['1987-05-11']);
        $this->assertArrayHasKey('hourly', $weather['1987-05-11']);
        $this->assertArrayHasKey('daily', $weather['1987-05-11']);
        $this->assertArrayHasKey('flags', $weather['1987-05-11']);

        $this->assertArrayHasKey('currently', $weather['1988-05-11']);
        $this->assertArrayHasKey('hourly', $weather['1988-05-11']);
        $this->assertArrayHasKey('daily', $weather['1988-05-11']);
        $this->assertArrayHasKey('flags', $weather['1988-05-11']);
    }

    /** @test */
    public function when_array_passed_you_can_also_set_the_desired_response_block_as_a_string()
    {
        $weather = (new DarkSky(46.4825, 30.7233))->timeMachine(['1986-05-11', '1987-05-11'], 'daily');

        $this->assertCount(2, $weather);

        $this->assertArrayHasKey('1986-05-11', $weather);
        $this->assertArrayHasKey('1987-05-11', $weather);

        $this->assertArrayHasKey('daily', $weather['1986-05-11']);
        $this->assertArrayNotHasKey('currently', $weather['1986-05-11']);
        $this->assertArrayNotHasKey('hourly', $weather['1986-05-11']);
        $this->assertArrayNotHasKey('flags', $weather['1986-05-11']);

        $this->assertArrayHasKey('daily', $weather['1987-05-11']);
        $this->assertArrayNotHasKey('currently', $weather['1987-05-11']);
        $this->assertArrayNotHasKey('hourly', $weather['1987-05-11']);
        $this->assertArrayNotHasKey('flags', $weather['1987-05-11']);
    }

    /** @test */
    public function when_array_passed_you_can_also_set_the_desired_response_blocks_as_an_array()
    {
        $weather = (new DarkSky(46.4825, 30.7233))->timeMachine(['1986-05-11', '1987-05-11'], ['daily', 'flags']);

        $this->assertCount(2, $weather);

        $this->assertArrayHasKey('1986-05-11', $weather);
        $this->assertArrayHasKey('1987-05-11', $weather);

        $this->assertArrayHasKey('daily', $weather['1986-05-11']);
        $this->assertArrayHasKey('flags', $weather['1986-05-11']);
        $this->assertArrayNotHasKey('currently', $weather['1986-05-11']);
        $this->assertArrayNotHasKey('hourly', $weather['1986-05-11']);

        $this->assertArrayHasKey('daily', $weather['1987-05-11']);
        $this->assertArrayHasKey('flags', $weather['1987-05-11']);
        $this->assertArrayNotHasKey('currently', $weather['1987-05-11']);
        $this->assertArrayNotHasKey('hourly', $weather['1987-05-11']);
    }
}
