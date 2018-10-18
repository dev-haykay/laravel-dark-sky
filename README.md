# Laravel Dark Sky

[<img src="https://user-images.githubusercontent.com/1286821/43083932-4915853a-8ea0-11e8-8983-db9e0f04e772.png" alt="Become a Patron" width="160" />](https://www.patreon.com/illuminated)

[![StyleCI](https://github.styleci.io/repos/148543382/shield?branch=master&style=flat)](https://github.styleci.io/repos/148543382)
[![Build Status](https://travis-ci.com/dmitry-ivanov/laravel-dark-sky.svg?branch=master)](https://travis-ci.com/dmitry-ivanov/laravel-dark-sky)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-dark-sky/badge.svg?branch=master)](https://coveralls.io/github/dmitry-ivanov/laravel-dark-sky?branch=master)

[![Latest Stable Version](https://poser.pugx.org/illuminated/dark-sky/v/stable)](https://packagist.org/packages/illuminated/dark-sky)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/dark-sky/v/unstable)](https://packagist.org/packages/illuminated/dark-sky)
[![Total Downloads](https://poser.pugx.org/illuminated/dark-sky/downloads)](https://packagist.org/packages/illuminated/dark-sky)
[![License](https://poser.pugx.org/illuminated/dark-sky/license)](https://packagist.org/packages/illuminated/dark-sky)

[Dark Sky](https://darksky.net/dev) weather forecast for Laravel.

| Laravel | Dark Sky                                                            |
| ------- | :-----------------------------------------------------------------: |
| 5.5.*   | [5.5.*](https://github.com/dmitry-ivanov/laravel-dark-sky/tree/5.5) |
| 5.6.*   | [5.6.*](https://github.com/dmitry-ivanov/laravel-dark-sky/tree/5.6) |
| 5.7.*   | [5.7.*](https://github.com/dmitry-ivanov/laravel-dark-sky/tree/5.7) |

## Table of contents

- [Usage](#usage)
- [Forecast](#forecast)
- [Time Machine](#time-machine)
- [Customization](#customization)
  - [Language](#language)
  - [Units](#units)
  - [Extend](#extend)
- [Advanced](#advanced)
  - [Configuration](#configuration)
  - [Caching, caching, caching!](#caching-caching-caching)
- [License](#license)

## Usage

1. Install the package via Composer:

    ```shell
    composer require illuminated/dark-sky
    ```

2. Set the key in the `.env` file:

    ```
    DARK_SKY_KEY=[Your Secret Key]
    ```

3. Use `DarkSky` class:

    ```php
    use DarkSky;

    $forecast = DarkSky::at($latitude, $longitude)->forecast();
    ```

    > Check the [Dark Sky API](https://darksky.net/dev/docs) for more information about the response format.

    Try the [live demo](https://clearsky.live) now.

## Forecast

Get the weather forecast:

```php
$forecast = DarkSky::at($latitude, $longitude)->forecast();
```

Specify desired data blocks to reduce the response size:

```php
$forecast = DarkSky::at($latitude, $longitude)->forecast('daily');
$forecast = DarkSky::at($latitude, $longitude)->forecast(['daily', 'hourly']);
```

## Time Machine

Get the weather conditions for a particular date:

```php
$weather = DarkSky::at($latitude, $longitude)->timeMachine('1986-05-11');
```

Or get the weather conditions for several dates via [concurrent requests](http://docs.guzzlephp.org/en/stable/quickstart.html#concurrent-requests):

```php
$weather = DarkSky::at($latitude, $longitude)->timeMachine(['1986-05-11', '1987-05-11']);
```

Specify desired data blocks to reduce the response size:

```php
$weather = DarkSky::at($latitude, $longitude)->timeMachine('1986-05-11', 'daily');
$weather = DarkSky::at($latitude, $longitude)->timeMachine('1986-05-11', ['daily', 'hourly']);
```

## Customization

### Language

Change the language of response properties:

```php
$forecast = DarkSky::at($latitude, $longitude)->lang('ru')->forecast();
```

```php
$weather  = DarkSky::at($latitude, $longitude)->lang('ru')->timeMachine('1986-05-11');
```

### Units

Change the units of response weather conditions:

```php
$forecast = DarkSky::at($latitude, $longitude)->units('si')->forecast();
```

```php
$weather  = DarkSky::at($latitude, $longitude)->units('si')->timeMachine('1986-05-11');
```

### Extend

Extend hour-by-hour forecast to the next 168 hours, instead of the next 48:

```php
$forecast = DarkSky::at($latitude, $longitude)->extend()->forecast();
```

## Advanced

### Configuration

You can publish config to override default language, units, etc:

```shell
php artisan vendor:publish --provider="Illuminated\DarkSky\ServiceProvider"
```

### Caching, caching, caching!

> Each time you get the weather - you do the real API calls!

Use caching to improve your application speed and reduce API load:

```php
$forecast = Cache::remember($key, $minutes, function () {
    return DarkSky::at($latitude, $longitude)->forecast();
});
```

## License

The MIT License. Please see [License File](LICENSE) for more information.

[<img src="https://user-images.githubusercontent.com/1286821/43086829-ff7c006e-8ea6-11e8-8b03-ecf97ca95b2e.png" alt="Support on Patreon" width="125" />](https://www.patreon.com/illuminated)
