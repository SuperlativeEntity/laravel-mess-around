<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class CampaignCategory extends Model
{
    use RevisionableTrait, SoftDeletes;
}
