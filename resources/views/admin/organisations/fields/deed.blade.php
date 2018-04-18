{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('organisation.deed'),
        'name'          => 'deed',
        'type'          => 'text',
        'value'         => isset($organisation->deed) ? $organisation->deed : null,
        'placeholder'   => trans('organisation.deed')
    ])
!!}