<script>
    $(document).ready(function ()
    {
        var campaign_contacts_form  = $("#cleanup-contacts-form");
        var cleanup_contacts_btn    = $("#cleanup_contacts_btn");
        var campaign_contacts       = $("textarea#campaign_contacts");
        var contacts_count          = $("#contacts_count");
        var alert_modal             = $("#alert_modal");

        campaign_contacts_form.validate
        ({
            ignore              : null,
            ignore              : 'input[type="hidden"]',
            errorLabelContainer : "#validation-errors",
            wrapper             : "li",
            rules               :
            {
                campaign_contacts:
                {
                    required    : true
                }
            },
            messages:
            {
                campaign_contacts : '@lang('campaign.campaign_contacts_required')',
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

        cleanup_contacts_btn.click(function ()
        {
            if ($(campaign_contacts_form).valid())
            {
                $.ajax
                ({
                    url         : '{{ route('admin.campaign.cleanup_contacts') }}',
                    type        : "POST",
                    dataType    : "json",
                    data        : JSON.stringify(campaign_contacts_form.serializeObject()),
                    beforeSend: function ()
                    {
                        cleanup_contacts_btn.prop("disabled",true);
                        cleanup_contacts_btn.text('Preparing...');
                    },
                    success: function (data)
                    {
                        campaign_contacts.val(data.contacts);
                        contacts_count.text(data.contacts_count);

                        cleanup_contacts_btn.prop("disabled",false);
                        cleanup_contacts_btn.text('{{ trans('campaign.prepare_contacts') }}');
                    },
                    error: function (xhr, textStatus, thrownError)
                    {
                        console.log(xhr, textStatus, thrownError);
                    }
                });
            }
        });
    });
</script>