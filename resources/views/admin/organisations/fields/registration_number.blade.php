{!! Html::input
    ([
        'input_group'   => true,
        'label'         => trans('organisation.registration_number'),
        'name'          => 'registration_number',
        'type'          => 'text',
        'value'         => isset($organisation->registration_number) ? $organisation->registration_number : null,
        'placeholder'   => trans('organisation.registration_number_placeholder')
    ])
!!}