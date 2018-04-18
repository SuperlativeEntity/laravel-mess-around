<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Campaign extends Model
{
    use RevisionableTrait,SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\CampaignCategory','campaign_category_id');
    }

    public function type()
    {
        return $this->belongsTo('App\CampaignType','campaign_type_id');
    }
}
