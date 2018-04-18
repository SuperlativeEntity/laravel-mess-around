individual_save_btn.click(function ()
{
    if ($(individual_form).valid())
    {
        var args =
        {
            type                    : 'post',
            url                     : (individual_id.val() != '') ? '{{ route('admin.organisation.individual.update') }}' : '{{ route('admin.organisation.individual.store') }}',
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
            grid                    : individual_list_grid,
            grid_refresh            : true
        };

        constructAjax(args);
    }
});