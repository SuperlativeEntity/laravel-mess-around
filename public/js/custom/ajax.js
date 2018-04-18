function isJson(str)
{
    try
    {
        JSON.parse(str);
    }
    catch (e)
    {
        return false;
    }

    return true;
}

function constructAjax(args)
{
    var debug            = false;

    // note: the response code and messages property needs to be returned for this to display properly
    // e.g. return response()->json(((int)$response['code'] !== config('http_code.ok')) ? $response['messages'] : $response,$response['code']);
    var error_modal      = $(args['error_modal']);
    var success_modal    = $(args['success_modal']);

    var success_messages = $(args['success_element']);
    var error_messages 	 = $(args['error_element']);
    var message_type     = (typeof args['message_type'] == 'undefined') ? 'modal' : args['message_type'];

    var grid             = args['grid'];
    var grid_refresh     = args['grid_refresh'];

    var spinner_overlay  = $('#overlay');

    if (debug)
        console.log(args);

    $.ajax
    ({
        type    : args['type'],
        url     : args['url'],
        cache   : args['cache'],
        dataType: args['dataType'],
        data    : args['data'],
        beforeSend: function ()
        {
            error_messages.hide().empty();
            success_messages.hide().empty();
            spinner_overlay.show();
        },
        success: function (data)
        {
            if (debug)
            {
                console.log('success');
                console.log(data);
            }

            if (typeof args['redirect_url'] != 'undefined')
                window.location = args['redirect_url'];

            if (typeof grid != 'undefined' && typeof grid_refresh != 'undefined' && grid_refresh)
                grid.data('kendoGrid').dataSource.read();

            if (args['display_messages'])
            {
                var messages        = data['messages'];
                var id              = data['id']; // record recently created
                var redirect_url    = data['redirect_url']; // from controller
                var toast           = '';

                // override redirect if returned from controller
                if (typeof id != 'undefined' && typeof redirect_url != 'undefined')
                    args['inject_content_route'] = redirect_url+'/'+id;

                if (typeof messages != 'undefined')
                {
                    if (debug)
                        console.log(messages);

                    $.each(messages, function (index, value)
                    {
                        if (typeof success_messages != 'undefined')
                            success_messages.append('<div>' + value + '<div>');

                        if (message_type == 'toast')
                            toast += value;
                    });

                    if (message_type == 'modal')
                        success_messages.show();

                    if (message_type == 'toast')
                        toastr.success(toast,'',toastr_options);

                }
            }

            // @include('components/modal/success_modal',['title' => trans('label.success')])
            if (typeof success_modal != 'undefined' && message_type == 'modal')
                success_modal.modal('show');

            if (typeof args['inject_content'] != 'undefined' &&
                typeof args['inject_content_route'] != 'undefined' &&
                typeof args['inject_content_element'] != 'undefined')
            {
                if (args['inject_content_type'] == 'ajax')
                {
                    $.get(args['inject_content_route'], function (data)
                    {
                        $(args['inject_content_element']).fadeOut().html(data).fadeIn();
                    });
                }

                if (args['inject_content_type'] == 'pjax')
                {
                    $.pjax
                    ({
                        timeout     : 2000,
                        url         : args['inject_content_route'],
                        container   : args['inject_content_element']
                    });
                }
            }

            spinner.stop();
            spinner_overlay.hide();
        },
        error: function (xhr, textStatus, thrownError)
        {
            if (debug)
            {
                console.log('errors');
                console.log(xhr.responseText);
            }

            if (!isJson(xhr.responseText))
                window.location = login_url;

            if (isJson(xhr.responseText) && args['display_messages'] && typeof error_messages != 'undefined')
            {
                var errors = JSON.parse(xhr.responseText);

                if (debug)
                {
                    console.log('errors');
                    console.log(errors);
                    console.log('errors_message');
                    console.log(errors.message);
                    console.log('errors_errors');
                    console.log(errors.errors);
                }

                if (typeof errors != 'undefined')
                {
                    if (typeof errors.errors != 'undefined' && typeof errors.errors == 'object')
                    {
                        $.each(errors.errors, function (index, value)
                        {
                            if (debug)
                            {
                                console.log('index:'+index);
                                console.log('value:'+value);
                            }

                            error_messages.append('<div>' + value + '<div>');
                        });
                    }

                    if (typeof errors.errors == 'undefined')
                    {
                        error_messages.append('<div>' + errors + '<div>');
                    }

                    if (typeof errors.errors == 'string')
                    {
                        error_messages.append('<div>' + errors.errors + '<div>');
                    }

                    error_messages.show();
                }

                if (typeof error_modal != 'undefined')
                    error_modal.modal('show');
            }

            spinner.stop();
            spinner_overlay.hide();
        }
    });

    var spinner = new Spinner({
        lines   : 12,
        length  : 7,
        width   : 5,
        radius  : 10,
        color   : '#404143',
        speed   : 1,
        trail   : 0,
        shadow  : false,
        rotate  : 0
    }).spin(document.getElementById(args['spinner_element']));

    var toastr_options =
    {
        closeButton         : true,
        debug               : false,
        newestOnTop         : true,
        progressBar         : false,
        positionClass       : "toast-bottom-left",
        preventDuplicates   : true,
        onclick             : null,
        showDuration        : "300",
        hideDuration        : "1000",
        timeOut             : "5000",
        extendedTimeOut     : "1000",
        showEasing          : "swing",
        hideEasing          : "linear",
        showMethod          : "fadeIn",
        hideMethod          : "fadeOut"
    }

}