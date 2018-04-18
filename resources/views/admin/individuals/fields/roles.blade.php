<div id="roles_field">
    {!! Form::label('roles', trans('individual.roles'), ['class' => 'control-label"','id' => 'roles_label']) !!} {!! Html::required() !!}<br>
    <select id="roles" name="roles" multiple></select>
</div>