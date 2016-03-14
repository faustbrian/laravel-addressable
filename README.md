# Laravel Addressable

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require draperstudio/laravel-addressable
```

And then include the service provider within `app/config/app.php`.

``` php
'providers' => [
    DraperStudio\Addressable\ServiceProvider::class
];
```

To get started, you'll need to publish the vendor assets and migrate the countries table:

```bash
php artisan vendor:publish --provider="DraperStudio\Addressable\ServiceProvider" && php artisan migrate
```

Now you can seed the countries into the database like this.

```bash
php artisan countries:seed
```

## Usage

### Setup a Model
``` php
<?php

/*
 * This file is part of Laravel Addressable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

use DraperStudio\Addressable\Contracts\Addressable;
use DraperStudio\Addressable\Traits\Addressable as AddressableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Addressable
{
    use AddressableTrait;
}
```

### Set an address as Primary address
``` php
$user->primaryAddress(Address::find(1));
```

### Set an address as Billing address
``` php
$user->billingAddress(Address::find(2));
```

### Set an address as Shipping address
``` php
$user->shippingAddress(Address::find(3));
```

### Create a new address
``` php
$user->createAddress([
    'country_id' => Country::find(1)->id,
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

### Update an existing address
``` php
$user->updateAddress(Address::find(1), [
    'country_id' => Country::find(1)->id,
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

### Delete an existing address
``` php
$user->deleteAddress(Address::find(1));
```

### Find all Users which have an address within 5 miles around the given geo location
``` php
User::findByDistance(5, 'miles', $lat, $lng);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@draperstudio.tech instead of using the issue tracker.

## Credits

- [DraperStudio][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/DraperStudio/laravel-addressable.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/DraperStudio/Laravel-Addressable/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DraperStudio/laravel-addressable.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/DraperStudio/laravel-addressable.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/DraperStudio/laravel-addressable.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/DraperStudio/laravel-addressable
[link-travis]: https://travis-ci.org/DraperStudio/Laravel-Addressable
[link-scrutinizer]: https://scrutinizer-ci.com/g/DraperStudio/laravel-addressable/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DraperStudio/laravel-addressable
[link-downloads]: https://packagist.org/packages/DraperStudio/laravel-addressable
[link-author]: https://github.com/DraperStudio
[link-contributors]: ../../contributors
