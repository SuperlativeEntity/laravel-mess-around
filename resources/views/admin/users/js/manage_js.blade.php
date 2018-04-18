<script>
    $(document).ready(function ()
    {
        var form                = $("#save-user-validate");
        var save_btn            = $("#save_btn");
        var alert_modal         = $("#alert_modal");

        form.validate
        ({
            ignore              : null,
            ignore              : 'input[type="hidden"]',
            errorLabelContainer : "#validation-errors",
            wrapper             : "li",
            rules               :
            {
                email:
                {
                    required: true,
                    email   : true
                },
                first_name:
                {
                    required: true
                },
                last_name:
                {
                    required: true
                },
                @if (empty($user))
                password:
                {
                    required: true
                },
                @endif
                password_confirmation:
                {
                    @if (empty($user)){{ 'required: true,'  }}@endif
                    equalTo : "#password"
                }
            },
            messages:
            {
                first_name                      : '@lang('user.first_name_required')',
                last_name                       : '@lang('user.last_name_required')',
                password                        : '@lang('user.password_required')',
                password_confirmation:
                {
                    required                    : '@lang('user.password_confirmation_required')',
                    equalTo                     : '@lang('user.password_confirmation_match')'
                },
                email:
                {
                    required                    : '@lang('user.email_required')',
                    email                       : '@lang('user.email_validation')'
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

        save_btn.click(function ()
        {
            if ($(form).valid())
            {
                var args =
                {
                    type                    : 'post',
                    url                     : '{{ empty($user) ? route('admin.user.store') : route('admin.user.update') }}',
                    cache                   : false,
                    dataType                : 'json',
                    data                    : JSON.stringify(form.serializeObject()),
                    success_element         : undefined,
                    error_element           : '#validation-errors',
                    message_type            : 'toast',
                    display_messages        : true,
                    error_modal             : '#alert_modal',
                    success_modal           : undefined,
                    redirect_url            : undefined,
                    inject_content          : '{{ empty($member) ? 'true' : 'false' }}',
                    inject_content_type     : {!! empty($member) ? "'pjax'" : 'undefined' !!},
                    inject_content_route    : undefined,
                    inject_content_element  : {!! empty($member) ? "'#pjax-container'" : 'undefined' !!},
                    spinner_element         : 'user_spinner'
                };

                constructAjax(args);
            }
        });

    });
</script>