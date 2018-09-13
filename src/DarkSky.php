<?php

namespace Illuminated\DarkSky;

class DarkSky
{
    protected $latitude;
    protected $longitude;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = (float) $latitude;
        $this->longitude = (float) $longitude;
    }

    protected function url($time = null)
    {
        $key = config('dark-sky.key');

        $latitude = $this->latitude;
        $longitude = $this->longitude;
        $uri = collect([$latitude, $longitude, $time])->filter()->implode(',');

        return "https://api.darksky.net/forecast/{$key}/{$uri}";
    }
}
