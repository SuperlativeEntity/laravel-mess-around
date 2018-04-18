<?php namespace App\Validators;

class MobilePrefixValidator
{
    public static function validate($attribute, $value, $parameters)
    {
        return in_array(substr($value,0,3),config('system.valid_mobile_prefixes'));
    }
}