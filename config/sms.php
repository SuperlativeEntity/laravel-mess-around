<?php

// config('sms.first_sms')
return
[
    'credits_url'           => 'http://api.infobip.com/api/command?username={username}&password={password}&cmd=CREDITS',
    'supported_ranges'      => [6,7,8], // e.g. 061, 072, 084

    'replace_characters'    =>
    [
        'Á' => 'A','È' => 'E','É' => 'E','Ê' => 'E','Ë' => 'E','ö' => 'o','Í' => 'I','Î' => 'I','Ï' => 'I','Ó' => 'O',
        'Ô' => 'O','Ú' => 'U','Û' => 'U','Ý' => 'Y','á' => 'a','è' => 'e','é' => 'e','ê' => 'e','ë' => 'e','í' => 'i',
        'î' => 'i','ï' => 'i','ó' => 'o','ô' => 'o','ú' => 'u','û' => 'u','ý' => 'y','  ' => '','–' => '-','’' => "'",
        '“' => "'",'”' => "'",
    ],

    'first_sms'             => 160, // characters
    'second_sms'            => 145, // characters
    'three_or_more'         => 152, // characters
];