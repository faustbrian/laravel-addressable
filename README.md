# Laravel Addressable

## Installation

First, pull in the package through Composer.

```js
composer require draperstudio/laravel-addressable:1.0.*@dev
```

And then include the service provider within `app/config/app.php`.

```php
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

### Setup a Model
```php
<?php

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
```php
$user->primaryAddress(Address::find(1));
```

### Set an address as Billing address
```php
$user->billingAddress(Address::find(2));
```

### Set an address as Shipping address
```php
$user->shippingAddress(Address::find(3));
```

### Create a new address
```php
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
```php
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
```php
$user->deleteAddress(Address::find(1));
```

### Find all Users which have an address within 5 miles around the given geo location
```php
User::findByDistance(5, 'miles', $lat, $lng);
```
