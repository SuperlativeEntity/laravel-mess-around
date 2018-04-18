<?php

//$args = ['label' => 'Email Address','name' => 'email','type' => 'email','value' => 'email@home.co.za','placeholder' => 'Email Address','required_label' => 'Email Address is required'];
// {!! Html::input($args) !!}
Html::macro('input', function($args)
{
    $required = isset($args['required_label']) ? $args['required_label'] : trans('label.required');
    $setValue = isset($args['value']) ? $args['value'] : null;

    $input  = '<div id="'.$args['name'].'_group">';
    $input .= '<label class="control-label" id="'.$args['name'].'_label" for="'.$args['name'].'">'.$args['label'].'</label>';

    if ($args['input_group'])
        $input .= '<div class="input-group">';

    $input .= '<input class="form-control" type="'.$args['type'].'" id="'.$args['name'].'" name="'.$args['name'].'" placeholder="'.$args['placeholder'].'" value="'.$setValue.'">';

    if ($args['input_group'])
    {
        $input .= Html::input_add_on($required);
        $input .= '</div>';
    }

    $input .= '</div>';

    return $input;
});

// {!! Html::numeric_fields($fields) !!}
Html::macro('numeric_fields', function($fields)
{
    $buildString = null;

    if (\App\Helpers\GeneralHelper::isArrayWithValues($fields))
    {
        foreach ($fields as $field => $field_length)
        {
            $buildString .= "\n{$field}.forceNumericOnly();\n";
            $buildString .= "{$field}.attr('maxlength','".config('member.'.$field_length)."');\n";
            $buildString .= "{$field}.attr('minlength','".config('member.'.$field_length)."');\n";
        }
    }

    return $buildString."\n";
});