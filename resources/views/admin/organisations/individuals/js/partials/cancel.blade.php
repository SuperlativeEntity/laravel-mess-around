individual_cancel_btn.click(function ()
{
    individual_id.val('');
    first_name.val('');
    last_name.val('');
    id_number.val('');

    mobile.val('');
    home.val('');
    work.val('');
    individual_email.val('');

    birth_date.data("kendoDatePicker").value('');
    join_date.data("kendoDatePicker").value('');

    roles.data("kendoMultiSelect").value([]);

    if (typeof buildings_select != 'undefined' &&
        typeof buildings_select.data("kendoMultiSelect") != 'undefined')
    {
        buildings_select.data("kendoMultiSelect").value([]);
    }

    title_id.data("kendoDropDownList").value(null);
    language_id.data("kendoDropDownList").value(null);
    nationality_id.data("kendoDropDownList").value(null);

    individual_link.show();
    unlink_individual_btn.hide();

    individual_heading.text('@lang('individual.create')');
    individual_save_btn.html('{!! Html::save_button_icon(trans('button.create')) !!}');
});