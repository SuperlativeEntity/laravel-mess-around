{!! Html::input
    ([
        'input_group'   => true,
        'label'         => trans('individual.last_name'),
        'name'          => 'last_name',
        'type'          => 'text',
        'value'         => isset($individual) ? $individual->last_name : null,
        'placeholder'   => trans('individual.last_name')
    ])
!!}