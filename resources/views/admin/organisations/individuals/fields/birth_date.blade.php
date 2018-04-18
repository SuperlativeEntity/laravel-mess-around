{!! Form::label('birth_date', trans('individual.birth_date'), ['class' => 'control-label"','id' => 'birth_date_label']) !!}<br>
{!! Form::text('birth_date', isset($individual) ? $individual->birth_date : null,['name' => 'birth_date']) !!}<br>
