<?php

namespace BrianFaust\Addressable;

use Illuminate\Support\Collection;

trait HasAddressesTrait
{
    /**
     * @return mixed
     */
    public function addresses()
    {
        return $this->morphMany(config('addressable.models.address'), 'addressable');
    }

    /**
     * @param null $address
     *
     * @return mixed
     */
    public function primaryAddress($address = null)
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
    public function billingAddress($address = null)
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
    public function shippingAddress($address = null)
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
    public static function findByDistance($distance, $type, $lat, $lng)
    {
        $records = Address::within($distance, $type, $lat, $lng)->get();

        $results = [];
        foreach ($records as $record) {
            $results[] = $record->addressable;
        }

        return new Collection($results);
    }
}
