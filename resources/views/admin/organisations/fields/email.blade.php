{!! Html::input
    ([
        'input_group'   => true,
        'label'         => trans('organisation.email'),
        'name'          => 'email',
        'type'          => 'email',
        'value'         => isset($organisation->email) ? $organisation->email : null,
        'placeholder'   => trans('organisation.email')
    ])
!!}