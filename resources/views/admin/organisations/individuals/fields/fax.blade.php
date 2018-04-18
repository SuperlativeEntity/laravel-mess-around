{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('individual.fax'),
        'name'          => 'fax',
        'type'          => 'text',
        'value'         => isset($individual) ? $individual->fax : null,
        'placeholder'   => trans('individual.fax')
    ])
!!}