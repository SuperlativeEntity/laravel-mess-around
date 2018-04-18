{!! Html::input
    ([
        'input_group'   => true,
        'label'         => trans('organisation.phone'),
        'name'          => 'phone',
        'type'          => 'text',
        'value'         => isset($organisation->phone) ? $organisation->phone : null,
        'placeholder'   => trans('organisation.phone_placeholder')
    ])
!!}