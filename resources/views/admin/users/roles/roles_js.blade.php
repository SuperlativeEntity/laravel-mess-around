<script>
    $(document).ready(function ()
    {
        var roles               = $('select[id^="roles"]');
        var form                = $("#modify-roles-validate");
        var update_roles_btn    = $("#update_roles_btn");
        var alert_modal         = $("#alert_modal");

        roles.kendoMultiSelect
        ({
            dataTextField   : "name",
            dataValueField  : "id",
            dataSource:
            {
                transport:
                {
                    read:
                    {
                        dataType: "json",
                        url     : '{{ route('admin.role.list') }}'
                    }
                }
            },
            value:
            [
                @if (isset($user_roles))
                    @foreach ($user_roles as $user_role)
                    {{ "{id:$user_role->id}," }}
                    @endforeach
                @endif
            ]
        });

        form.validate
        ({
            ignore              : null,
            ignore              : 'input[type="hidden"]',
            errorLabelContainer : "#validation-errors",
            wrapper             : "li",
            rules               :
            {
                roles:
                {
                    required: true
                }
            },
            messages:
            {
                roles : '@lang('role.roles_required')'
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

        update_roles_btn.click(function ()
        {
            if ($(form).valid())
            {
                var args =
                {
                    type                    : 'post',
                    url                     : '{{ route('admin.user.assign_roles') }}',
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
                    inject_content          : true,
                    inject_content_type     : 'pjax',
                    inject_content_route    : undefined,
                    inject_content_element  : undefined,
                    spinner_element         : 'user_spinner'
                };

                constructAjax(args);
            }
        });

    });
</script>