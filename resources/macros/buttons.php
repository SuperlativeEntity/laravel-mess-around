<?php

// {!! Html::grid_add_button(route('admin.user.create'),trans('user.create_user')) !!}
Html::macro('grid_add_button', function($route,$label)
{
    return "<a data-pjax class='k-button k-button-icontext k-grid-add' href='{$route}'>{$label}</a>";
});

// {!! Html::save_button('update_roles_btn',trans('button.save')) !!}
Html::macro('save_button', function($name,$label)
{
    return "<button type=\"button\" class=\"btn btn-success\" id=\"{$name}\"><i class=\"fa fa-floppy-o\" style=\"font-size: 25px\"></i>&nbsp;&nbsp;{$label}</button>";
});

Html::macro('save_button_icon', function($label)
{
    return "<i class=\"fa fa-floppy-o\" style=\"font-size: 25px\"></i>&nbsp;&nbsp;{$label}";
});

// {!! Html::create_button('capture_beneficiary_btn',trans('button.create')) !!}
Html::macro('create_button', function($name,$label)
{
    return "<button type=\"button\" class=\"btn btn-success\" id=\"{$name}\"><i class=\"fa fa-plus-circle\" style=\"font-size: 25px\"></i>&nbsp;&nbsp;{$label}</button>";
});

// {!! Html::cancel_button('cancel_roles_btn',trans('button.cancel')) !!}
Html::macro('cancel_button', function($name,$label)
{
    return "<button type=\"button\" class=\"btn btn-default\" id=\"{$name}\" style='background-color: #ECE9E9'><i class=\"fa fa-times-circle-o\" style=\"font-size: 25px\"></i>&nbsp;&nbsp;{$label}</button>";
});

// {!! Html::unlink_button('unlink_member_btn',trans('button.cancel')) !!}
Html::macro('unlink_button', function($name,$label)
{
    return "<button type=\"button\" class=\"btn btn-danger\" id=\"{$name}\" style='background-color: #cc4946'><i class=\"fa fa-unlink\" style=\"font-size: 25px\"></i>&nbsp;&nbsp;{$label}</button>";
});

// {!! Html::link_button('link_member_btn',trans('member.link_member')) !!}
Html::macro('link_button', function($name,$label)
{
    return "<button type=\"button\" class=\"btn btn-info\" id=\"{$name}\"><i class=\"fa fa-link\" style=\"font-size: 25px\"></i>&nbsp;&nbsp;{$label}</button>";
});

// {!! Html::generate_button('generate_btn',trans('button.generate')) !!}
Html::macro('generate_button', function($name,$label)
{
    return "<button type=\"button\" class=\"btn btn-success\" id=\"{$name}\"><i class=\"fa fa-cogs\" style=\"font-size: 25px\"></i>&nbsp;&nbsp;{$label}</button>";
});

// {!! Html::upload_button('upload_btn',trans('button.upload')) !!}
Html::macro('upload_button', function($name,$label)
{
    return "<button type=\"button\" class=\"btn btn-success\" id=\"{$name}\"><i class=\"fa fa-upload\" style=\"font-size: 25px\"></i>&nbsp;&nbsp;{$label}</button>";
});

// {!! Html::download_button('download_btn',trans('button.download')) !!}
Html::macro('download_button', function($name,$label)
{
    return "<button type=\"button\" class=\"btn btn-success\" id=\"{$name}\"><i class=\"fa fa-download\" style=\"font-size: 25px\"></i>&nbsp;&nbsp;{$label}</button>";
});