<?php

Breadcrumbs::register('admin.individual.index', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push(trans('individual.list'), route('admin.individual.index'));
});

Breadcrumbs::register('admin.individual.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.individual.index');
    $breadcrumbs->push(trans('individual.create'), route('admin.individual.create'));
});

Breadcrumbs::register('admin.individual.modify', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.individual.index');
    $breadcrumbs->push(trans('individual.modify'), route('admin.individual.modify'));
});