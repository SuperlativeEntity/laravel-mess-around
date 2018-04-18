individual_note_cancel_btn.click(function ()
{
    note_id.val('');
    individual_note_cancel_btn.hide();
    note.val('');

    individual_note_heading.text('@lang('individual_note.create')');
    individual_note_save_btn.html('{!! Html::save_button_icon(trans('button.create')) !!}');
});