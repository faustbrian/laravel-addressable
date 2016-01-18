<?php

namespace DraperStudio\Addressable\Traits;

use DraperStudio\Addressable\Models\Address;
use Illuminate\Support\Collection;

trait Addressable
{
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function primaryAddress($address = null)
    {
        if (!empty($address)) {
            $address->update([
                'is_primary' => 1, 'is_billing' => 0, 'is_shipping' => 0,
            ]);
        }

        return $this->addresses()->orderBy('is_primary', 'DESC')->firstOrFail();
    }

    public function billingAddress($address = null)
    {
        if (!empty($address)) {
            $address->update([
                'is_primary' => 0, 'is_billing' => 1, 'is_shipping' => 0,
            ]);
        }

        return $this->addresses()->orderBy('is_billing', 'DESC')->firstOrFail();
    }

    public function shippingAddress($address = null)
    {
        if (!empty($address)) {
            $address->update([
                'is_primary' => 0, 'is_billing' => 0, 'is_shipping' => 1,
            ]);
        }

        return $this->addresses()->orderBy('is_shipping', 'DESC')->firstOrFail();
    }

    public function createAddress($data)
    {
        return $this->addresses()->save(new Address($data));
    }

    public function updateAddress($address, $data)
    {
        return $address->update($data);
    }

    public function deleteAddress($address)
    {
        return $address->delete();
    }

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
