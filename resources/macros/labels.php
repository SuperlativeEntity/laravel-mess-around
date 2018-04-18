<?php

// {!! Html::input_add_on(trans('label.required')) !!}
Html::macro('input_add_on', function($label)
{
    return "<span class=\"input-group-addon\" style=\"color: red\">{$label}</span>";
});

// {!! Html::required() !!}
Html::macro('required', function()
{
    return "<label style=\"color: red; font-size: medium\">*</label>";
});

// {!! Html::buffer() !!}
Html::macro('buffer', function()
{
    return "<label style=\"font-size: medium\">&nbsp;</label>";
});