<?php

namespace Illuminated\DarkSky;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Response;

class DarkSky
{
    protected $latitude;
    protected $longitude;
    protected $key;
    protected $lang;
    protected $units;
    protected $extend;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = (float) $latitude;
        $this->longitude = (float) $longitude;

        $this->key = config('dark-sky.key');
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

    public function forecast($blocks = '*')
    {
        return $this->request($this->url(), $this->options($blocks));
    }

    public function timeMachine($time, $blocks = '*')
    {
        if (!is_array($time)) {
            return $this->request($this->url($time), $this->options($blocks));
        }

        return $this->concurrentRequests($time, $this->options($blocks));
    }

    protected function request($url, array $options)
    {
        return json_decode((new Client)->get($url, $options)->getBody(), true);
    }

    protected function concurrentRequests(array $times, array $options)
    {
        $client = new Client;

        $promises = collect($times)->mapWithKeys(function ($time) use ($client, $options) {
            return [$time => $client->getAsync($this->url($time), $options)];
        });

        return collect(Promise\unwrap($promises))->map(function (Response $response) {
            return json_decode($response->getBody(), true);
        })->toArray();
    }

    protected function url($time = null)
    {
        $latitude = $this->latitude;
        $longitude = $this->longitude;
        $uri = collect([$latitude, $longitude, $this->time($time)])->filter()->implode(',');

        return "https://api.darksky.net/forecast/{$this->key}/{$uri}";
    }

    protected function time($time = null)
    {
        if (is_null($time)) {
            return null;
        }

        $method = is_int($time) ? 'createFromTimestampUTC' : 'parse';

        return Carbon::{$method}($time)->format('Y-m-d\TH:i:s');
    }

    protected function options($blocks = '*')
    {
        return [
            'decode_content' => 'gzip',
            'query' => [
                'lang' => $this->lang,
                'units' => $this->units,
                'extend' => $this->extend,
                'exclude' => $this->exclude($blocks),
            ],
        ];
    }

    protected function exclude($included = '*')
    {
        $exclude = null;

        $included = collect($included);
        $all = collect(['currently', 'minutely', 'hourly', 'daily', 'alerts', 'flags']);

        if ($all->intersect($included)->isNotEmpty()) {
            $exclude = $all->diff($included)->implode(',');
        }

        return $exclude;
    }
}
