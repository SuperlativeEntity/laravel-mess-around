<?php

Breadcrumbs::register('index', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('index'));
});