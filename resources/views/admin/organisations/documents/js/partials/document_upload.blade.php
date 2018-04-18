document_uploader.hide();

document_selected.kendoUpload
({
    async:
    {
        saveUrl   : "{{ route('admin.organisation.document.store') }}",
        autoUpload: true
    },
    validation:
    {
        allowedExtensions: {!! $allowed_extensions !!},
        maxFileSize      : 4194304
    },
    upload  : onUpload,
    complete: onComplete,
});

function onUpload(e)
{
    e.data =
    {
        _token           : '{{ csrf_token() }}',
        linked_to        : 'organisation',
        organisation_id  : {{ $organisation->id }},
        document_type_id : current_document_type_value,
    };
}

function onComplete(e)
{
    document_list_grid.data('kendoGrid').dataSource.read();
}

document_type_id.change(function()
{
    if (parseInt(this.value) === 0)
    {
        document_uploader.hide();
    }

    if (parseInt(this.value) > 0)
    {
        document_uploader.show();
        current_document_type_value = parseInt(this.value);

        document_id.val('');
        document_heading.text('@lang('document.upload')');
        document_cancel_btn.hide();
        document_download_btn.hide();
    }
});