{!! Html::input
    ([
        'input_group'   => false,
        'label'         => trans('individual.email_secondary'),
        'name'          => 'email_secondary',
        'type'          => 'email',
        'value'         => isset($individual) ? $individual->email_secondary : null,
        'placeholder'   => trans('individual.email_secondary')
    ])
!!}