{!! Form::label('building_type_id', trans('building.building_type'), ['class' => 'control-label"','id' => 'building_type_id_label']) !!} {!! Html::required() !!}<br>
{!! Form::select('building_type_id', [],null,['id' => 'building_type_id','tabindex'=>300]) !!}