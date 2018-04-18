<?php

namespace App\Repositories;

interface IActivityRepository
{
    public function log($args);
}