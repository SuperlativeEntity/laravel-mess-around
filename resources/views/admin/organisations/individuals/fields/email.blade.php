{!! Html::input
    ([
        'input_group'   => true,
        'label'         => trans('individual.email'),
        'name'          => 'individual_email',
        'type'          => 'email',
        'value'         => isset($individual) ? $individual->email : null,
        'placeholder'   => trans('individual.email')
    ])
!!}