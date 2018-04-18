{!! Html::input
    ([
        'input_group' => true,
        'label' => trans('organisation.name'),
        'name' => 'name',
        'type' => 'text',
        'value' => isset($organisation->name) ? $organisation->name : null,
        'placeholder' => trans('organisation.name_placeholder')
    ])
!!}