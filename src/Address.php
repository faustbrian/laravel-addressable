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
use Jackpopp\GeoDistance\GeoDistanceTrait;

class Address extends Model
{
    use GeoDistanceTrait;

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(config('addressable.models.country'));
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($address) {
            if (config('addressable.geocode')) {
                $address->geocode();
            }

            if (empty($address->country_id)) {
                $defaultCountry = config('addressable.default_country');

                $country = Country::where('cca2', '=', $defaultCountry)->first(['id']);

                $address->country_id = $country->id;
            }
        });
    }

    /**
     * @return $this
     */
    public function geocode()
    {
        if (!empty($this->postcode)) {
            $string[] = $this->street;
            $string[] = sprintf('%s, %s %s', $this->city, $this->state, $this->postcode);
            $string[] = $this->country_name;
        }

        $query = str_replace(' ', '+', implode(', ', $string));

        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$query.'&sensor=false');
        $output = json_decode($geocode);

        if (count($output->results)) {
            $this->lat = $output->results[0]->geometry->location->lat;
            $this->lng = $output->results[0]->geometry->location->lng;
        }

        return $this;
    }
}
