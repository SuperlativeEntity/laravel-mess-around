individual_note_form.validate
({
    ignore              : null,
    ignore              : 'input[type="hidden"]',
    errorLabelContainer : "#validation-errors",
    wrapper             : "li",
    rules               :
    {
        note_type_id:
        {
            required: true
        },
        note:
        {
            required: true
        }
    },
    messages:
    {
        note_type_id   : '@lang('individual_note.note_type_required')',
        note           : '@lang('individual_note.note_required')',
     },
    invalidHandler: function(form, validator)
    {
        var errors = validator.numberOfInvalids();

        if (errors > 0)
        {
            alert_modal.modal('show');
        }
    }
});