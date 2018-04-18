// titles
renderDropDown({ element:title_id, option:'@lang('individual.title_select')', url:'{{ route('admin.drop_down.list',['name' => 'Title']) }}' });

// languages
renderDropDown({ element:language_id, option:'@lang('individual.language_select')', url:'{{ route('admin.drop_down.list',['name' => 'Language']) }}' });

// nationalities
renderDropDown({ element:nationality_id, option:'@lang('individual.nationality_select')', url:'{{ route('admin.drop_down.list',['name' => 'Nationality']) }}' });

// communication
renderDropDown({ element:communication, option:'@lang('individual.communication_select')', url:'{{ route('admin.drop_down.list',['name' => 'Choice']) }}' });

// newsletter
renderDropDown({ element:newsletter, option:'@lang('individual.newsletter_select')', url:'{{ route('admin.drop_down.list',['name' => 'Choice']) }}' });