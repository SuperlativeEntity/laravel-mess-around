<?php namespace App\Helpers;

class GeneralHelper
{
    public static function isArrayWithValues($array)
    {
        return (isset($array) && is_array($array) && count($array) > 0) ? true : false;
    }

    public static function flattenArray(array $array)
    {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }

    public static function getAcronym($word)
    {
        preg_match_all("/[A-Z]/", ucwords(strtolower($word)),$initials);

        return implode("",$initials[0]);
    }

}