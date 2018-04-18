<?php namespace App\Validators;

use App\Helpers\IdNumberHelper;

class SouthAfricanIdentityNumberValidator
{
    public static function validate($attribute, $value, $parameters)
    {
        return IdNumberHelper::validateIdNumber($attribute, $value, $parameters);
    }
}