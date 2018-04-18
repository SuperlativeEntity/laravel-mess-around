{!! Html::input
    ([
        'input_group'   => true,
        'label'         => trans('campaign.name'),
        'name'          => 'name',
        'type'          => 'text',
        'value'         => isset($campaign) ? $campaign->name : null,
        'placeholder'   => trans('campaign.name')
    ])
!!}