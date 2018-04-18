@if (empty($organisation))
    var organisation_type   = renderDropDown({ element:organisation_type_id, option:'@lang('organisation.organisation_type_select')', url:'{{ route('admin.drop_down.list',['name' => 'OrganisationType']) }}' });
@endif

@if (isset($organisation))
    var organisation_type   = renderDropDown({ selected_item: '{{ $organisation->organisation_type_id }}',element:organisation_type_id, option:'@lang('organisation.organisation_type_select')', url:'{{ route('admin.drop_down.list',['name' => 'OrganisationType']) }}' });

    @if (empty($parent))
        var organisation    = renderDropDown({ element:organisation_id, option:'@lang('organisation.falls_under_select')', url:'{{ route('admin.organisation.all') }}' });
    @endif

    @if (isset($parent))
        var organisation    = renderDropDown({ selected_item: '{{ $parent->first()->id }}', element:organisation_id, option:'@lang('organisation.falls_under_select')', url:'{{ route('admin.organisation.all') }}' });
    @endif
@endif