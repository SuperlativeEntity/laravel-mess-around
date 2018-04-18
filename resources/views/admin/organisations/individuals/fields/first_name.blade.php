{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('individual.first_name'),
        'name'          => 'first_name',
        'type'          => 'text',
        'value'         => isset($individual) ? $individual->first_name : null,
        'placeholder'   => trans('individual.first_name')
    ])
!!}