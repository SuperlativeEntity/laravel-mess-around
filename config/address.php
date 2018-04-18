<?php

// config('address.western_cape_province')
return
[
    'postal_address'        => 1,
    'physical_address'      => 2,
    'address_fields'        => ['street_postbox','additional','suburb','town','city','province_id','postal_code'],
    'clone_fields'          => ['street_postbox','additional','suburb','town','city','postal_code'],
    'postal_code_length'    => 4,
    'western_cape_province' => 9,
];