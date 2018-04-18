<?php namespace App\Helpers;

class IdNumberHelper
{
    private static function generateLuhnDigit($input)
    {
        $total = 0;
        $count = 0;

        for ($i = 0; $i < strlen($input); $i++)
        {
            $multiple = ($count % 2) + 1;
            $count++;

            $temp = $multiple * $input[$i];

            $temp = (int)floor($temp / 10) + ($temp % 10);
            $total += $temp;
        }

        $total = ($total * 9) % 10;

        return $total;
    }

    public static function generateIdNumber($dateOfBirth, $male)
    {
        $gender     = self::getRandom(5) + ($male ? 5 : 0);
        $citizen    = 0;
        $random     = self::getRandom(1000);

        if ($random < 10)
        {
            $random = "00".$random;
        }
        else if ($random < 100)
        {
            $random = "0".$random;
        }

        $total = $dateOfBirth.$gender.$random.$citizen.'8';
        $total .= self::generateLuhnDigit($total);

        return $total;
    }

    public static function getRandom($range)
    {
        return mt_rand(1,$range);
    }

    public static function generateDateOfBirth()
    {
        return str_pad(mt_rand(60,99),2,'0',STR_PAD_LEFT).str_pad(mt_rand(1,12),2,'0',STR_PAD_LEFT).str_pad(mt_rand(1,28),2,'0',STR_PAD_LEFT);
    }

    public static function getGenderCode($idNumber)
    {
        return (substr($idNumber,6,4) < 5000) ? config('member.gender_female') : config('member.gender_male'); // assuming 1 is male
    }

    public static function getBirthDate($idNumber)
    {
        $default_century = config('member.default_century');

        if ($default_century.substr($idNumber,0,2) < config('member.birth_date_cutoff')) $default_century++;

        $year   = $default_century.substr($idNumber,0,2);
        $month  = str_pad(substr($idNumber,2,2),'0',STR_PAD_LEFT);
        $day    = str_pad(substr($idNumber,4,2),'0',STR_PAD_LEFT);

        return $year.'-'.$month.'-'.$day;
    }

    public static function validateIdNumber($attribute, $value, $parameters)
    {
        /*
            {YYMMDD}{G}{SSS}{C}{A}{Z}
            YYMMDD: Date of birth
            G : Gender. 0-4 Female; 5-9 Male.
            SSS : Sequence No. for DOB/G combination.
            C : Citizenship. 0 SA; 1 Other.
            A : Usually 8, or 9 (can be other values)
            Z : Control digit.
        */

        $match = preg_match ("!^(\d{2})(\d{2})(\d{2})\d{7}$!", $value, $matches);

        if (!$match)
            return false;

        list (, $year, $month, $day) = $matches;

        if ($year == '00')
            $year = 2000;

        if (!checkdate($month, $day, $year))
            return false;

        $d = -1;

        $a = 0;

        for($i = 0; $i < 6; $i++)
        {
            $a += $value{2*$i};
        }

        $b = 0;

        for($i = 0; $i < 6; $i++)
        {
            $b = $b*10 + $value{2*$i+1};
        }

        $b *= 2;

        $c = 0;

        do
        {
            $c += $b % 10;
            $b = $b / 10;
        }
        while($b > 0);

        $c += $a;
        $d = 10 - ($c % 10);

        if ($d == 10) $d = 0;

        if ($value{strlen($value)-1} == $d)
            return true;

        return false;
    }
}