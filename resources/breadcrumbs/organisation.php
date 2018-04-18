<?php

Breadcrumbs::register('admin.organisation.index', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push(trans('organisation.list'), route('admin.organisation.index'));
});

Breadcrumbs::register('admin.organisation.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.organisation.index');
    $breadcrumbs->push(trans('organisation.create'), route('admin.organisation.create'));
});

Breadcrumbs::register('admin.organisation.modify', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.organisation.index');
    $breadcrumbs->push(trans('organisation.modify'), route('admin.organisation.modify'));
});