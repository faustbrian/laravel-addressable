<?php

/*
 * This file is part of Laravel Addressable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BrianFaust\Addressable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait HasAddresses
{
    /**
     * @return \BrianFaust\Addressable\Address
     */
    public function getAddressAttribute()
    {
        return $this->primaryAddress();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(config('addressable.models.address'), 'addressable');
    }

    /**
     * @param null $address
     *
     * @return mixed
     */
    public function primaryAddress($address = null): Model
    {
        if (!empty($address)) {
            $address->update([
                'is_primary' => 1, 'is_billing' => 0, 'is_shipping' => 0,
            ]);
        }

        return $this->addresses()->orderBy('is_primary', 'DESC')->firstOrFail();
    }

    /**
     * @param null $address
     *
     * @return mixed
     */
    public function billingAddress($address = null): Model
    {
        if (!empty($address)) {
            $address->update([
                'is_primary' => 0, 'is_billing' => 1, 'is_shipping' => 0,
            ]);
        }

        return $this->addresses()->orderBy('is_billing', 'DESC')->firstOrFail();
    }

    /**
     * @param null $address
     *
     * @return mixed
     */
    public function shippingAddress($address = null): Model
    {
        if (!empty($address)) {
            $address->update([
                'is_primary' => 0, 'is_billing' => 0, 'is_shipping' => 1,
            ]);
        }

        return $this->addresses()->orderBy('is_shipping', 'DESC')->firstOrFail();
    }

    /**
     * @param $distance
     * @param $type
     * @param $lat
     * @param $lng
     *
     * @return Collection
     */
    public static function findByDistance($distance, $type, $lat, $lng): Collection
    {
        $records = Address::within($distance, $type, $lat, $lng)->get();

        $results = [];
        foreach ($records as $record) {
            $results[] = $record->addressable;
        }

        return new Collection($results);
    }
}
