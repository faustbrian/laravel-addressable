<?php

namespace DraperStudio\Addressable\Contracts;

interface Addressable
{
    public function addresses();

    public function primaryAddress($address);

    public function billingAddress($address);

    public function shippingAddress($address);

    public function createAddress($data);

    public function updateAddress($address, $data);

    public function deleteAddress($address);

    public static function findByDistance($distance, $type, $lat, $lng);
}
