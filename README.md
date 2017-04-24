# Laravel Addressable

I would appreciate you taking the time to look at my [Patreon](https://www.patreon.com/faustbrian) and considering to support me if I'm saving you some time with my work.

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-addressable
```

Now add the service provider within `app/config/app.php`.

``` php
'providers' => [
    // ...
    BrianFaust\Addressable\AddressableServiceProvider::class
];
```

You can publish the migration with:

```bash
$ php artisan vendor:publish --provider="BrianFaust\Addressable\AddressableServiceProvider" --tag="migrations"
```

After the migration has been published you can create the role- and permission-tables by running the migrations:

```bash
$ php artisan migrate
```

You can publish the config file with:

```bash
$ php artisan vendor:publish --provider="BrianFaust\Addressable\AddressableServiceProvider" --tag="config"
```

## Usage

### Setup a Model
``` php
<?php

namespace App;

use BrianFaust\Addressable\HasAddresses;
use BrianFaust\Addressable\Interfaces\HasAddress;
use Illuminate\Database\Eloquent\Model;

class Order extends Model implements HasAddress
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

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.de)
