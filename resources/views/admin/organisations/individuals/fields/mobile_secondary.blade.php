{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('individual.mobile_secondary'),
        'name'          => 'mobile_secondary',
        'type'          => 'text',
        'value'         => isset($individual) ? $individual->mobile_secondary : null,
        'placeholder'   => trans('individual.mobile_secondary')
    ])
!!}