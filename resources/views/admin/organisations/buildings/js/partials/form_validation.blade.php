building_form.validate
({
    ignore              : null,
    ignore              : 'input[type="hidden"]',
    errorLabelContainer : "#validation-errors",
    wrapper             : "li",
    rules               :
    {
        erf:
        {
            required: true
        },
        district_id:
        {
            required: true
        },
        valcon_registered_id:
        {
            required: true
        },
        building_name:
        {
            required: true
        }
    },
    messages:
    {
        erf                  : '@lang('building.erf_required')',
        province_id          : '@lang('building.province_required')',
        district_id          : '@lang('building.district_required')',
        valcon_registered_id : '@lang('building.valcon_registered_required')',
        building_name        : '@lang('building.name_required')'
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