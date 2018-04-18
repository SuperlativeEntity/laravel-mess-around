<?php

Breadcrumbs::register('admin.user.index', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push(trans('user.list'), route('admin.user.index'));
});

Breadcrumbs::register('admin.user.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push(trans('user.create_user'), route('admin.user.create'));
});

Breadcrumbs::register('admin.user.modify', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push(trans('user.modify_user'), route('admin.user.modify'));
});