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
- [Forecast Request](#forecast-request)
- [Time Machine Request](#time-machine-request)
- [Customizing requests](#customizing-requests)
  - [Blocks](#blocks)
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

    $forecast = (new DarkSky($latitude, $longitude))->forecast();
    ```

    Check [Dark Sky API](https://darksky.net/dev/docs) for more information about response format.

## Forecast Request

Get the weather forecast:

```php
$forecast = (new DarkSky($latitude, $longitude))->forecast();
```

## Time Machine Request

Get the weather conditions for a particular date:

```php
$weather = (new DarkSky($latitude, $longitude))->timeMachine('1986-05-11');
```

Get the weather conditions for several particular dates, concurrent requests used:

```php
$weather = (new DarkSky($latitude, $longitude))->timeMachine(['1986-05-11', '1987-05-11']);
```

## Customizing requests

### Blocks

Get only required data from API:

```php
$forecast = (new DarkSky($latitude, $longitude))->forecast('daily');
$forecast = (new DarkSky($latitude, $longitude))->forecast(['daily', 'hourly']);
```

```php
$weather = (new DarkSky($latitude, $longitude))->timeMachine('1986-05-11', 'daily');
$weather = (new DarkSky($latitude, $longitude))->timeMachine('1986-05-11', ['daily', 'hourly']);
```

## License

The MIT License. Please see [License File](LICENSE) for more information.

[<img src="https://user-images.githubusercontent.com/1286821/43086829-ff7c006e-8ea6-11e8-8b03-ecf97ca95b2e.png" alt="Support on Patreon" width="125" />](https://www.patreon.com/illuminated)
