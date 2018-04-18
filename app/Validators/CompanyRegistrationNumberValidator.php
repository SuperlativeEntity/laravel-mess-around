<?php namespace App\Validators;

class CompanyRegistrationNumberValidator
{
    public static function validate($attribute, $value, $parameters)
    {
        return (preg_match('#^\d{4}/\d{6}/\d{2}$#', $value) === 1);
    }
}