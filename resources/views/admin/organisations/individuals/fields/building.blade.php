@if (isset($building_count) && $building_count > 0)
    {!! Form::label('buildings',  trans('building.plural'), ['class' => 'control-label"','id' => 'buildings_label']) !!}<br>
    <select id="buildings" name="buildings" multiple tabindex="411"></select>
@endif