<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Organisation extends Model
{
    use RevisionableTrait, SoftDeletes;

    protected $revisionCreationsEnabled = true;

    public function parent()
    {
        return $this->belongsToMany(Organisation::class, 'organisation_relations', 'child_id', 'parent_id')->withTimestamps();
    }

    public function child()
    {
        return $this->belongsToMany(Organisation::class, 'organisation_relations', 'parent_id', 'child_id')->withTimestamps();
    }

    public function individuals($role_id)
    {
        return $this->belongsToMany('App\Individual','organisation_individuals')->where('role_id', '=', $role_id)->withTimestamps();
    }

    public function addresses()
    {
        return $this->belongsToMany('App\Address','organisation_addresses')->withTimestamps();
    }

    public function buildings()
    {
        return $this->belongsToMany('App\Building','organisation_buildings')->withTimestamps();
    }

    public function documents()
    {
        return $this->belongsToMany('App\Document','organisation_documents')->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo('App\OrganisationType','organisation_type_id');
    }
}