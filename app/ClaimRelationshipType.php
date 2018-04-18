<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class ClaimRelationshipType extends Model
{
    use RevisionableTrait, SoftDeletes;
}