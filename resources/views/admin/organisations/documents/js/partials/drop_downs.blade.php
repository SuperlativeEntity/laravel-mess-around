var document_types = renderDropDown({ element:document_type_id, option:'@lang('document.document_type_select')', url:'{{ route('admin.drop_down.list',['name' => 'DocumentType']) }}' });