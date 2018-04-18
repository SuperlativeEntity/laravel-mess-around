<?php

// {!! Html::model_columns($columns) !!}
Html::macro('model_columns', function($columns)
{
    $output = null;

    foreach ($columns as $column)
    {
        $output .= $column['name'].':{ type: "'.$column['type'].'" },';
    }

    return $output;

});

// {!! Html::display_columns($columns) !!}
Html::macro('display_columns', function($columns)
{
    $output = null;

    foreach ($columns as $column)
    {
        $output .= '{field:"'.$column['name'].'",';
        $output .= 'title:"'.trans($column['title']).'",';
        $output .= 'hidden:'.$column['hidden'].',';
        $output .= 'filterable:'.$column['filterable'].'},';
    }

    return $output;

});

// {!! Html::string_operators($operators) !!}
Html::macro('string_operators', function($operators)
{
    $output = null;

    foreach ($operators as $operator)
    {
        $output .= $operator.':"'.trans('grid.'.$operator).'",';
    }

    return $output;

});