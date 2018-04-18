<?php

Breadcrumbs::register('admin.campaign.index', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push(trans('campaign.list'), route('admin.campaign.index'));
});

Breadcrumbs::register('admin.campaign.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.campaign.index');
    $breadcrumbs->push(trans('campaign.create'), route('admin.campaign.create'));
});

Breadcrumbs::register('admin.campaign.modify', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.campaign.index');
    $breadcrumbs->push(trans('campaign.modify'), route('admin.campaign.modify'));
});