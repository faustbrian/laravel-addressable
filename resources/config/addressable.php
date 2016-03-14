<?php


return [

    'flags' => ['primary', 'billing', 'shipping'],

    'default_country' => 'US',

    'geocode' => false,

    'encrypt' => false,

    'encryptColumns' => [
        'organization',
        'name_prefix',
        'name_suffix',
        'first_name',
        'last_name',
        'street',
        'building_number',
        'building_flat',
        'city',
        'city_prefix',
        'city_suffix',
        'state',
        'state_code',
        'postcode',
        'phone',
    ],

];
