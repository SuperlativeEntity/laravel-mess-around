// select a record to modify
building_list_grid.click(function()
{
    var view            = $(this).data("kendoGrid");
    var selectedItem    = view.dataItem(view.select());

    if (typeof selectedItem != 'undefined' && selectedItem != null &&
    typeof selectedItem.id != 'undefined' && selectedItem.id != null)
    {
        building_id.val(selectedItem.id);

        building_cancel_btn.show();
        building_heading.text('@lang('building.update')');
        building_save_btn.html('{!! Html::save_button_icon(trans('button.update')) !!}');

        $.ajax
        ({
            url     : '{{ route('admin.organisation.building.record') }}/'+selectedItem.id,
            type    : "GET",
            dataType: "json",
            success : function (data)
            {
                building_name.val(data.name);
                valuation_amount.val(data.valuation_amount);
                erf.val(data.erf);
                province_id.data("kendoDropDownList").value(parseInt(data.province_id));
                district_id.data("kendoDropDownList").value(parseInt(data.district_id));
                valcon_registered_id.data("kendoDropDownList").value(parseInt(data.valcon_registered_id));
                valcon_number.val(data.valcon_number);
                address.val(data.address);
            }
        });
    }
});