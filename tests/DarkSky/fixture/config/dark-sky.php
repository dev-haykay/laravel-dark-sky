<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Secret Key
    |--------------------------------------------------------------------------
    |
    | Secret key grants you access to the Dark Sky API. It must be kept secret.
    | Don't embed it in JavaScript source code that you transmit to clients.
    | Trial account allows up to 1000 free calls per day to Dark Sky API.
    |
    */

    'key' => env('DARK_SKY_KEY', '43e427ceb504ec730f9cc258bab1a81d'),

    /*
    |--------------------------------------------------------------------------
    | Extend Forecast
    |--------------------------------------------------------------------------
    |
    | Use this option to extend the forecast request with an additional data.
    | For example, hour-by-hour data can be extended from 48 to 168 hours.
    | Note that this option has no effect on the time machine requests.
    |
    | Supported: "hourly", null.
    |
    */

    'extend' => null,

    /*
    |--------------------------------------------------------------------------
    | Language
    |--------------------------------------------------------------------------
    |
    | Use this option to set the language for returned `summary` properties.
    | Units in the `summary` will be set according to the `units` option.
    | Be sure to set both options appropriately in your configuration.
    |
    */

    'lang' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Units
    |--------------------------------------------------------------------------
    |
    | Use this option to set the units for weather meteorological conditions.
    | You can choose from the number of the most widely-used unit systems.
    | Or just use the auto selection, based on the geographic location.
    |
    | Supported: "auto", "ca", "uk2", "us", "si".
    |
    */

    'units' => 'si',

];
