form.validate
({
    ignore              : null,
    ignore              : 'input[type="hidden"]',
    errorLabelContainer : "#validation-errors",
    wrapper             : "li",
    rules               :
    {
        organisation_type_id:
        {
            required    : true
        },
        name:
        {
            required    : true
        },
        email           :
        {
            required    : true,
            email       : true
        },
        registration_number :
        {
            required    : true
        },
        phone           :
        {
            required    : true,
            number      : true,
        }
    },
    messages:
    {
        organisation_type_id    : '@lang('organisation.organisation_type_required')',
        name                    : '@lang('organisation.name_required')',
        registration_number     : '@lang('organisation.registration_number_required')',
        phone                   :
        {
            required            : '@lang('organisation.phone_required')',
            number              : '@lang('organisation.phone_numeric')',
        },
        email                   :
        {
            required            : '@lang('organisation.email_required')',
            email               : '@lang('organisation.email_valid')',
        },
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