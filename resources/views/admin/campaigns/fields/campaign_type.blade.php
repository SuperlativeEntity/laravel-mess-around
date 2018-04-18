{!! Form::label('campaign_type_id', trans('campaign.campaign_type'), ['class' => 'control-label"','id' => 'campaign_type_id_label']) !!} {!! Html::required() !!}<br>
{!! Form::select('campaign_type_id', [],null,['id' => 'campaign_type_id','tabindex'=>100]) !!}
<br>