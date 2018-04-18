<?php

namespace App\Repositories;

use Regulus\ActivityLog\Models\Activity;

class ActivityRepository implements IActivityRepository
{
    public function log($args)
    {
        Activity::log
        ([
            'userId'        => $args['userId'],
            'contentId'     => $args['contentId'],
            'contentType'   => $args['contentType'],
            'action'        => $args['action'],
            'description'   => $args['description'],
            'details'       => $args['details'],
        ]);
    }
}