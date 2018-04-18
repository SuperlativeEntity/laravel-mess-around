<?php

namespace App\Repositories;

class SmsRepository implements ISmsRepository
{
    public function __construct()
    {
    }

    public function getCredits()
    {
        $url = config('sms.credits_url');
        $url = str_replace("{username}",env('SMS_USERNAME'),$url);
        $url = str_replace("{password}",env('SMS_PASSWORD'),$url);

        return (int)file_get_contents($url) / 100;
    }
}