<?php

// @lang('building.generate_message1')
// trans('building.generated_successfully')

return
[
    'plural'                        => 'Properties',
    'list'                          => 'List of Properties',
    'create'                        => 'Create Property',
    'update'                        => 'Update Property',

    'building_type'                 => 'Property Type',
    'building_type_select'          => 'Select Property Type',
    'building_type_required'        => 'Property Type is Required',
    'name'                          => 'Name',
    'name_required'                 => 'Name is Required',
    'erf'                           => 'DOT Number',
    'erf_required'                  => 'DOT Number is Required',
    'address'                       => 'Address',

    'valuation_amount'              => 'Valuation Amount',
    'valuation_amount_required'     => 'Valuation Amount is Required',

    'province'                      => 'Province',
    'province_select'               => 'Select Province',
    'province_required'             => 'Province is Required',

    'valcon_number'                 => 'Valcon Number (If Registered)',
    'valcon_registered'             => 'Registered with Valcon',
    'valcon_registered_select'      => 'Please select Choice',
    'valcon_registered_required'    => 'Please select Yes or No for Valcon Registration',

    'district'                      => 'District',
    'district_select'               => 'Select District',
    'district_required'             => 'District is Required',

    'generate'                      => 'Generate Properties',
    'generate_number_of_required'   => 'Number of Properties Required',
    'generate_number_of'            => 'Number of Properties (E.g. 30)',
    'generate_message1'             => 'This functionality will generate the buildings as [NUMBER] [ORGANISATION NAME]. E.g. 1 Clearwater Falls, 2 Clearwater Falls etc.',
    'generate_message2'             => 'NOTE: This functionality should only be used if all the units under an organisation have a uniform name. E.g. Clearwater Falls has 30 units, and they are named unit 1 to 30. <br><strong>If there are x amount of units and they each have their own unique name E.g. 123 Banana Street or Blueberry Lodge this functionality should NOT be used.</strong>',
    'generate_error_count'          => 'Cannot generate buildings on an organisation that already has buildings',
    'generated_match'               => 'Properties generated does not match the requested number',

    'successfully_saved'            => 'Property successfully Saved',
    'generated_successfully'        => 'Properties Successfully Generated',
    'generation_failed'             => 'Properties Failed to Generate',
    'generation_attach_failed'      => 'Failed to attach Properties to Organisation',
    'failed_to_save'                => 'Property failed to Save',
    'click_to_edit'                 => 'Click on Record to Edit',
];