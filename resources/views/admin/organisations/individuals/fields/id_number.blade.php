{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('individual.id_number'),
        'name'          => 'id_number',
        'type'          => 'text',
        'value'         => isset($individual) ? $individual->id_number : null,
        'placeholder'   => trans('individual.id_number')
    ])
!!}