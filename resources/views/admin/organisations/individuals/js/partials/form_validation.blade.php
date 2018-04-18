$.validator.addMethod("id_number", validateIdNumber, "@lang('individual.id_number_invalid')");

individual_form.validate
({
    ignore              : null,
    ignore              : 'input[type="hidden"]',
    errorLabelContainer : "#validation-errors",
    wrapper             : "li",
    rules               :
    {
        language_id     :
        {
            required    : true
        },
        communication   :
        {
            required    : true
        },
        newsletter      :
        {
            required    : true
        },
        nationality_id  :
        {
            required    : true
        },
        last_name       :
        {
            required    : true
        },
        individual_email:
        {
            required    : true,
            email       : true
        },
        email_secondary:
        {
            email       : true
        },
        roles           :
        {
            required    : true
        },
        home:
        {
            digits      : true
        },
        mobile:
        {
            digits      : true
        },
        mobile_secondary:
        {
            digits      : true
        }
    },
    messages:
    {
        first_name              : '@lang('individual.first_name_required')',
        last_name               : '@lang('individual.last_name_required')',
        roles                   : '@lang('individual.roles_select')',
        title_id                : '@lang('individual.title_required')',
        language_id             : '@lang('individual.language_required')',
        nationality_id          : '@lang('individual.nationality_required')',
        communication           : '@lang('individual.communication_required')',
        newsletter              : '@lang('individual.newsletter_required')',
        id_number               :
        {
            required            : '@lang('individual.id_number_required')',
        },
        mobile                  :
        {
            required            : '@lang('individual.mobile_required')',
        },
        individual_email        :
        {
            required            : '@lang('individual.email_required')',
            email               : '@lang('individual.email_invalid')'
        },
        email_secondary         :
        {
            email               : '@lang('individual.email_sec_invalid')'
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