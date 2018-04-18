// select a record to modify
document_list_grid.click(function()
{
    var view            = $(this).data("kendoGrid");
    var selectedItem    = view.dataItem(view.select());

    if (typeof selectedItem != 'undefined' && selectedItem != null &&
    typeof selectedItem.id != 'undefined' && selectedItem.id != null)
    {
        document_id.val(selectedItem.id);
        document_download_btn.show();
        document_cancel_btn.show();
        document_uploader.hide();

        $.ajax
        ({
            url     : '{{ route('admin.organisation.document.record') }}/'+selectedItem.id,
            type    : "GET",
            dataType: "json",
            success : function (data)
            {
                document_type_id.data("kendoDropDownList").value(parseInt(data.document_type_id));
                document_download_link.attr('href','{{ route('admin.organisation.document.download') }}/'+selectedItem.id);
                document_heading.text('@lang('document.download') : '+data.name);
            }
        });
    }
});