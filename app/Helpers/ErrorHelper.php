<?php namespace App\Helpers;

class ErrorHelper
{
    public static function failed($message)
    {
        return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [$message]];
    }
}