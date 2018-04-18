// select a record to modify
individual_list_grid.click(function()
{
    var view            = $(this).data("kendoGrid");
    var selectedItem    = view.dataItem(view.select());

    individual_link.hide();

    if (typeof selectedItem != 'undefined' && selectedItem != null &&
    typeof selectedItem.id != 'undefined' && selectedItem.id != null)
    {
        individual_id.val(selectedItem.id);

        individual_cancel_btn.show();
        unlink_individual_btn.show();
        individual_save_btn.html('{!! Html::save_button_icon(trans('button.update')) !!}');

        $.ajax
        ({
            url     : '{{ route('admin.organisation.individual.record') }}/'+selectedItem.id,
            type    : "GET",
            dataType: "json",
            success : function (data)
            {
                individual_heading.text('@lang('individual.update') : @lang('individual.member_number') #' + data.id);

                initials.val(data.initials);
                first_name.val(data.first_name);
                last_name.val(data.last_name);
                id_number.val(data.id_number);

                mobile.val(data.mobile);
                mobile_secondary.val(data.mobile_secondary);
                home.val(data.home);
                work.val(data.work);
                individual_email.val(data.email);
                email_secondary.val(data.email_secondary);

                birth_date.data("kendoDatePicker").value(data.birth_date);
                join_date.data("kendoDatePicker").value(data.join_date);

                title_id.data("kendoDropDownList").value(parseInt(data.title_id));
                language_id.data("kendoDropDownList").value(parseInt(data.language_id));
                nationality_id.data("kendoDropDownList").value(parseInt(data.nationality_id));
                communication.data("kendoDropDownList").value(parseInt(data.communication));
                newsletter.data("kendoDropDownList").value(parseInt(data.newsletter));
            }
        });

        $.ajax
        ({
            url     : '{{ route('admin.organisation.individual.role_ids') }}/'+organisation_id.val()+'/'+selectedItem.id,
            type    : "GET",
            dataType: "json",
            success : function (data)
            {
                if (data.roles.length == 0)
                    roles.data("kendoMultiSelect").value([]);

                if (data.roles.length > 0)
                    roles.data("kendoMultiSelect").value(data.roles);
            }
        });

        if (typeof buildings_select != 'undefined' &&
            typeof buildings_select.data("kendoMultiSelect") != 'undefined')
        {
            $.ajax
            ({
                url     : '{{ route('admin.organisation.individual.building_ids') }}/'+organisation_id.val()+'/'+selectedItem.id,
                type    : "GET",
                dataType: "json",
                success : function (data)
                {
                    if (data.buildings.length == 0)
                        buildings_select.data("kendoMultiSelect").value([]);

                    if (data.buildings.length > 0)
                        buildings_select.data("kendoMultiSelect").value(data.buildings);
                }
            });
        }
    }
});