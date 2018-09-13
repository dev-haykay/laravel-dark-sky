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

    'key' => env('DARK_SKY_KEY', null),

];
