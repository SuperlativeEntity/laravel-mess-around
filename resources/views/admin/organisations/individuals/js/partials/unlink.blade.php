unlink_individual_btn.click(function ()
{
    var individual_organisation_id  = $('#individual_organisation_id');
    var individual_id               = $('#individual_id');

    var unlinkObject = { organisation_id:individual_organisation_id.val(), individual_id:individual_id.val() };

    var args =
    {
        type                    : 'post',
        url                     : '{{ route('admin.organisation.individual.unlink') }}',
        cache                   : false,
        dataType                : 'json',
        data                    : JSON.stringify(unlinkObject),
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

    if (confirm('@lang('individual.unlink_confirm')'))
    {
        constructAjax(args);

        individual_cancel_btn.trigger('click',[]);
    }

});