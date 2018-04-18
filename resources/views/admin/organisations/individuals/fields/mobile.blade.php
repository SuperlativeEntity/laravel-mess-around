{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('individual.mobile'),
        'name'          => 'mobile',
        'type'          => 'text',
        'value'         => isset($individual) ? $individual->mobile : null,
        'placeholder'   => trans('individual.mobile')
    ])
!!}