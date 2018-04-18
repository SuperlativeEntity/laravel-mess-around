individual_save_btn.click(function ()
{
    if ($(individual_form).valid())
    {
        var args =
        {
            type                    : 'post',
            url                     : '{{ route('admin.individual.store') }}',
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
            inject_content          : 'true',
            inject_content_type     : 'pjax',
            inject_content_route    : undefined,
            inject_content_element  : '#pjax-container',
            spinner_element         : 'individual_spinner',
            grid                    : undefined,
            grid_refresh            : false
        };

        constructAjax(args);
    }
});