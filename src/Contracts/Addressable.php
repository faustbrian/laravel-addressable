<?php

/*
 * This file is part of Laravel Addressable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Addressable\Contracts;

/**
 * Interface Addressable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
interface Addressable
{
    /**
     * @return mixed
     */
    public function addresses();

    /**
     * @param $address
     *
     * @return mixed
     */
    public function primaryAddress($address);

    /**
     * @param $address
     *
     * @return mixed
     */
    public function billingAddress($address);

    /**
     * @param $address
     *
     * @return mixed
     */
    public function shippingAddress($address);

    /**
     * @param $data
     *
     * @return mixed
     */
    public function createAddress($data);

    /**
     * @param $address
     * @param $data
     *
     * @return mixed
     */
    public function updateAddress($address, $data);

    /**
     * @param $address
     *
     * @return mixed
     */
    public function deleteAddress($address);

    /**
     * @param $distance
     * @param $type
     * @param $lat
     * @param $lng
     *
     * @return mixed
     */
    public static function findByDistance($distance, $type, $lat, $lng);
}
