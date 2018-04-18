<?php

// @lang('organisation.claim_number')
// trans('organisation.claim_number')

return
[
    'plural'                            => 'Claims',
    'list'                              => 'List of Claims',
    'hierarchy'                         => 'Hierarchy',

    'organisation_type'                 => 'Claim Type',
    'organisation_type_select'          => 'Select a Type',
    'organisation_type_required'        => 'Claim Type is Required',
    'create'                            => 'Create Claim',
    'modify_short'                      => 'Modify',
    'modify'                            => 'Modify Claim',
    'basic'                             => 'Basic Information',

    'successfully_created'              => 'Claim successfully Created',
    'failed_to_create'                  => 'Claim failed to Create',
    'successfully_updated'              => 'Claim successfully Updated',
    'failed_to_update'                  => 'Claim failed to Update',

    'claim_number'                      => 'Claim #',

    'name'                              => 'Name',
    'name_placeholder'                  => 'Individual or Company Name',
    'name_required'                     => 'Name is Required',

    'deed'                              => 'Deed in Favour',

    'registration_number'               => 'Number',
    'registration_number_required'      => 'Number is Required',
    'registration_number_placeholder'   => 'Individual Id Number or Company Registration Number',

    'phone'                             => 'Phone Number',
    'phone_placeholder'                 => 'Phone Number E.g. 0118896632',
    'phone_numeric'                     => 'Phone Number can only be Numbers',
    'phone_length'                      => 'Phone Number needs to be :digits Numbers',
    'phone_required'                    => 'Phone Number is Required',

    'email'                             => 'Email Address',
    'email_required'                    => 'Email Address is Required',
    'email_valid'                       => 'Please capture a valid Email Address',

    'falls_under'                       => 'Parent Claim',
    'falls_under_select'                => 'Select',

    'circular_reference'                => 'You cannot link a claim to itself',
    'already_has_parent'                => 'The parent claim you are trying to link to is already linked to another claim',
    'missing'                           => 'Cannot find the Claim',
    'no_buildings'                      => 'No properties captured under Claim',
];