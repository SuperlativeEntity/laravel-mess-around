@if (isset($individual))
    // titles
    renderDropDown({ selected_item: '{{ $individual->title_id }}',element:title_id, option:'@lang('individual.title_select')', url:'{{ route('admin.drop_down.list',['name' => 'Title']) }}' });

    // languages
    renderDropDown({ selected_item: '{{ $individual->language_id }}',element:language_id, url:'{{ route('admin.drop_down.list',['name' => 'Language']) }}' });

    // nationalities
    renderDropDown({ selected_item: '{{ $individual->nationality_id }}',element:nationality_id, option:'@lang('individual.nationality_select')', url:'{{ route('admin.drop_down.list',['name' => 'Nationality']) }}' });

    // communication
    renderDropDown({ selected_item: '{{ $individual->communication }}',element:communication, option:'@lang('individual.communication_select')', url:'{{ route('admin.drop_down.list',['name' => 'Choice']) }}' });

    // newsletter
    renderDropDown({ selected_item: '{{ $individual->newsletter }}',element:newsletter, option:'@lang('individual.newsletter_select')', url:'{{ route('admin.drop_down.list',['name' => 'Choice']) }}' });
@endif

@if (empty($individual))
    // titles
    renderDropDown({ element:title_id, option:'@lang('individual.title_select')', url:'{{ route('admin.drop_down.list',['name' => 'Title']) }}' });

    // languages
    renderDropDown({ element:language_id, url:'{{ route('admin.drop_down.list',['name' => 'Language']) }}' });

    // nationalities
    renderDropDown({ element:nationality_id, option:'@lang('individual.nationality_select')', url:'{{ route('admin.drop_down.list',['name' => 'Nationality']) }}' });

    // communication
    renderDropDown({ element:communication, option:'@lang('individual.communication_select')', url:'{{ route('admin.drop_down.list',['name' => 'Choice']) }}' });

    // newsletter
    renderDropDown({ element:newsletter, option:'@lang('individual.newsletter_select')', url:'{{ route('admin.drop_down.list',['name' => 'Choice']) }}' });
@endif