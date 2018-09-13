<?php

namespace Illuminated\DarkSky;

class DarkSky
{
    protected $latitude;
    protected $longitude;
    protected $extend;
    protected $lang;
    protected $units;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = (float) $latitude;
        $this->longitude = (float) $longitude;
        $this->extend = config('dark-sky.extend');
        $this->lang = config('dark-sky.lang');
        $this->units = config('dark-sky.units');
    }

    public function extend($blocks = 'hourly')
    {
        $this->extend = $blocks;

        return $this;
    }

    public function lang($language)
    {
        $this->lang = $language;

        return $this;
    }

    public function units($units)
    {
        $this->units = $units;

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
