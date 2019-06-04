# Laravel Addressable

[![Build Status](https://img.shields.io/travis/artisanry/Addressable/master.svg?style=flat-square)](https://travis-ci.org/artisanry/Addressable)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/artisanry/addressable.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/artisanry/Addressable.svg?style=flat-square)](https://github.com/artisanry/Addressable/releases)
[![License](https://img.shields.io/packagist/l/artisanry/Addressable.svg?style=flat-square)](https://packagist.org/packages/artisanry/Addressable)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require artisanry/addressable
```

You can publish the migration with:

```bash
$ php artisan vendor:publish --provider="Artisanry\Addressable\AddressableServiceProvider" --tag="migrations"
```

After the migration has been published you can create the tables by running the migrations:

```bash
$ php artisan migrate
```

You can publish the config file with:

```bash
$ php artisan vendor:publish --provider="Artisanry\Addressable\AddressableServiceProvider" --tag="config"
```

## Usage

### Setup a Model
``` php
<?php

namespace App;

use Artisanry\Addressable\HasAddresses;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasAddresses;
}
```

### Get an address by role
``` php
$user->address('billing');
```

### Set the role of an address
``` php
$user->address('billing', Address::find(1));
```

### Create a new address (with a role)
``` php
$user->address('shipping', [
    'country_id' => 26,
    'name_prefix' => 'Mrs',
    'first_name' => 'John',
    'last_name' => 'Doe',
    'street' => 'JohnDoe Lane',
    'building_number' => 123,
    'city' => 'New York',
    'state' => 'New York',
    'postcode' => 12345,
]);
```

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@basecode.sh. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://basecode.sh)
