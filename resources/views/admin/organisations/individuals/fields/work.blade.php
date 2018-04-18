{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('individual.work'),
        'name'          => 'work',
        'type'          => 'text',
        'value'         => isset($individual) ? $individual->work : null,
        'placeholder'   => trans('individual.work')
    ])
!!}