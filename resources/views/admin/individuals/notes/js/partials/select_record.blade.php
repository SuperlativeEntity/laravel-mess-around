// select a record to modify
individual_note_list_grid.click(function()
{
    var view            = $(this).data("kendoGrid");
    var selectedItem    = view.dataItem(view.select());

    if (typeof selectedItem != 'undefined' && selectedItem != null &&
    typeof selectedItem.id != 'undefined' && selectedItem.id != null)
    {
        note_id.val(selectedItem.id);

        individual_note_cancel_btn.show();
        individual_note_heading.text('@lang('individual_note.update')');
        individual_note_save_btn.html('{!! Html::save_button_icon(trans('button.update')) !!}');

        $.ajax
        ({
            url     : '{{ route('admin.individual.note.record') }}/'+selectedItem.id,
            type    : "GET",
            dataType: "json",
            success : function (data)
            {
                note.val(data.note);
                note_type_id.data("kendoDropDownList").value(parseInt(data.note_type_id));
            }
        });
    }
});