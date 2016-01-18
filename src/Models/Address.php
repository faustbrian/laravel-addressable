<?php

namespace DraperStudio\Addressable\Models;

use Illuminate\Database\Eloquent\Model;
use DraperStudio\Countries\Models\Country;
use Jackpopp\GeoDistance\GeoDistanceTrait;
use DraperStudio\Database\Traits\Models\EncryptAttributes;

class Address extends Model
{
    use GeoDistanceTrait, EncryptAttributes;

    protected $table = 'addresses';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
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

    public function getNameAttribute()
    {
        return sprintf(
            '%s %s %s %s', $this->name_prefix, $this->name_suffix,
            $this->first_name, $this->last_name
        );
    }

    public function getAddressAttribute()
    {
        return sprintf('%s, %s %s', $this->city, $this->state, $this->postcode);
    }

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

    protected static function getEncryptedAttributes()
    {
        return config('addressable.encrypt')
                    ? config('addressable.encryptColumns')
                    : [];
    }
}
