{!! Form::label('join_date', trans('individual.join_date'), ['class' => 'control-label"','id' => 'join_date_label']) !!}<br>
{!! Form::text('join_date', isset($individual) ? $individual->join_date : null,['name' => 'join_date']) !!}<br>