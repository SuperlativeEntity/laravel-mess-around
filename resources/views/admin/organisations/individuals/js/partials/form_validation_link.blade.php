individual_link_form.validate
({
    ignore              : null,
    ignore              : 'input[type="hidden"]',
    errorLabelContainer : "#validation-errors",
    wrapper             : "li",
    rules               :
    {
        id_number_link  :
        {
            required    : true
        }
    },
    messages:
    {
        id_number_link          :
        {
            required            : '@lang('individual.id_number_required')'
        }
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