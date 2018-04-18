<script>
    $(document).ready(function ()
    {
        var individual_form         = $('#save-individual-validate');
        var create_account_btn      = $('#create_account_btn');

        create_account_btn.click(function()
        {
            var args =
            {
                type                    : 'post',
                url                     : '{{ route('admin.individual.account.create') }}',
                cache                   : false,
                dataType                : 'json',
                data                    : JSON.stringify(individual_form.serializeObject()),
                success_element         : undefined,
                error_element           : '#validation-errors',
                message_type            : 'toast',
                display_messages        : true,
                error_modal             : '#alert_modal',
                success_modal           : undefined,
                redirect_url            : undefined,
                inject_content          : 'false',
                inject_content_type     : undefined,
                inject_content_route    : undefined,
                inject_content_element  : undefined,
                spinner_element         : 'individual_spinner',
                grid                    : undefined,
                grid_refresh            : 'false'
            };

            constructAjax(args);
        });

    });
</script>