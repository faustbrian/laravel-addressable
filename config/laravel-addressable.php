<?php

/*
 * This file is part of Laravel Addressable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Eloquent Models
    |--------------------------------------------------------------------------
    */

    'models' => [

        /*
        |--------------------------------------------------------------------------
        | Address Model
        |--------------------------------------------------------------------------
        */

        'address' => \BrianFaust\Addressable\Models\Address::class,

        /*
        |--------------------------------------------------------------------------
        | Country Model
        |--------------------------------------------------------------------------
        */

        'country' => \BrianFaust\Countries\Models\Country::class,

    ],

];
