{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('individual.initials'),
        'name'          => 'initials',
        'type'          => 'text',
        'value'         => isset($individual) ? $individual->initials : null,
        'placeholder'   => trans('individual.initials')
    ])
!!}