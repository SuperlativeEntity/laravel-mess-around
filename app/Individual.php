<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Individual extends Model
{
    use RevisionableTrait, SoftDeletes;

    protected $revisionCreationsEnabled = true;

    // $organisation->pivot->role_id
    public function organisations()
    {
        return $this->belongsToMany('App\Organisation','organisation_individuals')->withPivot('role_id')->withTimestamps();
    }

    // $individual->organisationsByRole(config('role.director'))->get()
    public function organisationsByRole($role_id)
    {
        return $this->belongsToMany('App\Organisation','organisation_individuals')->where('role_id', '=', $role_id)->withTimestamps();
    }

    public function addresses()
    {
        return $this->belongsToMany('App\Address','individual_addresses')->withTimestamps();
    }

    public function buildings()
    {
        return $this->belongsToMany('App\Building','individual_buildings')->withTimestamps();
    }

    public function notes()
    {
        return $this->belongsToMany('App\Note','individual_notes')->withTimestamps();
    }

    public function getEmailAttribute($value)
    {
        return strtolower($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function getFirstNameAttribute($value)
    {
        return title_case($value);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = title_case($value);
    }

    public function getLastNameAttribute($value)
    {
        return title_case($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = title_case($value);
    }
}
