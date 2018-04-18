form.validate
({
    ignore              : null,
    ignore              : 'input[type="hidden"]',
    errorLabelContainer : "#validation-errors",
    wrapper             : "li",
    rules               :
    {
        name:
        {
            required    : true
        },
        start_date:
        {
            required    : true
        },
        campaign_category_id:
        {
            required    : true
        },
        campaign_type_id:
        {
            required    : true
        },
    },
    messages:
    {
        name                    : '@lang('campaign.name_required')',
        start_date              : '@lang('campaign.start_date_required')',
        campaign_category_id    : '@lang('campaign.campaign_category_required')',
        campaign_type_id        : '@lang('campaign.campaign_type_required')',
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