<?php

namespace Illuminated\DarkSky;

class DarkSky
{
    protected $latitude;
    protected $longitude;
    protected $lang;
    protected $units;
    protected $extend;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = (float) $latitude;
        $this->longitude = (float) $longitude;

        $this->lang = config('dark-sky.lang');
        $this->units = config('dark-sky.units');
        $this->extend = config('dark-sky.extend');
    }

    public function lang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    public function units($units)
    {
        $this->units = $units;

        return $this;
    }

    public function extend($blocks = 'hourly')
    {
        $this->extend = $blocks;

        return $this;
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
