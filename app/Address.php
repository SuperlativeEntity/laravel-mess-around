<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Address extends Model
{
    use RevisionableTrait, SoftDeletes;

    protected $revisionCreationsEnabled = true;

    public function getStreetPostboxAttribute($value)
    {
        return strtoupper($value);
    }

    public function setStreetPostboxAttribute($value)
    {
        $this->attributes['street_postbox'] = strtoupper($value);
    }

    public function getAdditionalAttribute($value)
    {
        return strtoupper($value);
    }

    public function setAdditionalAttribute($value)
    {
        $this->attributes['additional'] = strtoupper($value);
    }

    public function getSuburbAttribute($value)
    {
        return strtoupper($value);
    }

    public function setSuburbAttribute($value)
    {
        $this->attributes['suburb'] = strtoupper($value);
    }

    public function getTownAttribute($value)
    {
        return strtoupper($value);
    }

    public function setTownAttribute($value)
    {
        $this->attributes['town'] = strtoupper($value);
    }

    public function getCityAttribute($value)
    {
        return strtoupper($value);
    }

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = strtoupper($value);
    }

    public function type()
    {
        return $this->belongsTo('App\AddressType','address_type_id');
    }
}
