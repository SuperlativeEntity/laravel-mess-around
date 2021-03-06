save_btn.click(function ()
{
    if ($(form).valid())
    {
        var args =
        {
            type                    : 'post',
            url                     : '{{ empty($campaign) ? route('admin.campaign.store') : route('admin.campaign.update') }}',
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
            inject_content          : '{{ empty($campaign) ? 'true' : 'false' }}',
            inject_content_type     : {!! empty($campaign) ? "'pjax'" : 'undefined' !!},
            inject_content_route    : undefined,
            inject_content_element  : {!! empty($campaign) ? "'#pjax-container'" : 'undefined' !!},
            spinner_element         : 'campaign_spinner'
        };

        constructAjax(args);
    }
});