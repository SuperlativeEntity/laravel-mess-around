<script>
    $(document).ready(function ()
    {
        var campaign_sms_form       = $("#cleanup-sms-form");
        var cleanup_sms_message_btn = $("#cleanup_sms_message_btn");
        var sms_message             = $("textarea#sms_message");
        var alert_modal             = $("#alert_modal");

        campaign_sms_form.validate
        ({
            ignore              : null,
            ignore              : 'input[type="hidden"]',
            errorLabelContainer : "#validation-errors",
            wrapper             : "li",
            rules               :
            {
                sms_message:
                {
                    required    : true
                }
            },
            messages:
            {
                sms_message     : '@lang('campaign.sms_message_required')'
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

        cleanup_sms_message_btn.click(function ()
        {
            if ($(campaign_sms_form).valid())
            {
                $.ajax
                ({
                    url         : '{{ route('admin.campaign.cleanup_sms_message') }}',
                    type        : "POST",
                    dataType    : "json",
                    data        : JSON.stringify(campaign_sms_form.serializeObject()),
                    beforeSend: function ()
                    {
                        cleanup_sms_message_btn.prop("disabled",true);
                        cleanup_sms_message_btn.text('Preparing...');
                    },
                    success: function (data)
                    {
                        sms_message.val(data.sms_message);

                        cleanup_sms_message_btn.prop("disabled",false);
                        cleanup_sms_message_btn.text('{{ trans('campaign.update_sms_message') }}');
                    },
                    error: function (xhr, textStatus, thrownError)
                    {
                        console.log(xhr, textStatus, thrownError);
                    }
                });
            }
        });


        var part1Count = {{ config('sms.first_sms') }};
        var part2Count = {{ config('sms.second_sms') }};
        var part3Count = {{ config('sms.three_or_more') }};

        sms_message.keyup(function()
        {
            var chars = $(this).val().length;
            messages = 0;
            remaining = 0;
            total = 0;

            if (chars <= part1Count) {
                messages = 1;
                remaining = part1Count - chars;
            } else if (chars <= (part1Count + part2Count)) {
                messages = 2;
                remaining = part1Count + part2Count - chars;
            } else if (chars > (part1Count + part2Count)) {
                moreM = Math.ceil((chars - part1Count - part2Count) / part3Count) ;
                remaining = part1Count + part2Count + (moreM * part3Count) - chars;
                messages = 2 + moreM;
            }

            $('#remaining').text(remaining);
            $('#messages').text(messages);
            $('#total').text(chars);

            if (remaining > 1) $('.cplural').show();
            else $('.cplural').hide();
            if (messages > 1) $('.mplural').show();
            else $('.mplural').hide();
            if (chars > 1) $('.tplural').show();
            else $('.tplural').hide();
        });

        sms_message.keyup();
    });
</script>