{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('individual.home'),
        'name'          => 'home',
        'type'          => 'text',
        'value'         => isset($individual) ? $individual->home : null,
        'placeholder'   => trans('individual.home')
    ])
!!}