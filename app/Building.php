<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Building extends Model
{
    use RevisionableTrait, SoftDeletes;

    protected $revisionCreationsEnabled = true;

    public function type()
    {
        return $this->belongsTo('App\BuildingType','building_type_id');
    }
}
