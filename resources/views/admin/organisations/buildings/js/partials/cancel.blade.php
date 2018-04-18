building_cancel_btn.click(function ()
{
    building_id.val('');
    building_cancel_btn.hide();

    building_name.val('');
    erf.val('');
    valuation_amount.val('');
    address.val('');
    valcon_number.val('');

    building_heading.text('@lang('building.create')');
    building_save_btn.html('{!! Html::save_button_icon(trans('button.create')) !!}');
});