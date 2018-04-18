<script>
    $(document).ready(function ()
    {
        var login_btn               = $('#login_btn');
        var reset_password_btn      = $('#reset_password_btn');

        var email                   = $('#email');
        var password                = $('#password');
        var forgot_password         = $('#forgot_password');

        var password_reset_errors   = $("#password-reset-errors");
        var password_reset_success  = $("#password-reset-success");

        email.focus();

        forgot_password.click(function ()
        {
            password_reset_errors.hide().empty();
            password_reset_success.hide().empty();

            $('#password_modal').modal('show');
        });

        login_btn.click(function ()
        {
            var form        = $('form#login');

            var args =
            {
                type                : 'post',
                url                 : '{{ route('auth.credentials') }}',
                cache               : false,
                dataType            : 'json',
                data                : JSON.stringify(form.serializeObject()),
                success_element     : undefined,
                error_element       : '#validation-errors',
                display_messages    : true,
                error_modal         : undefined,
                success_modal       : undefined,
                redirect_url        : '{{ route('index') }}',
                spinner_element     : 'spinner'
            };

            constructAjax(args);
        });

        // if enter is pressed, try and login
        email.keypress(function(event)
        {
            if (event.which == 13)
            {
                event.preventDefault();
                login_btn.click();
            }
        });

        // if enter is pressed, try and login
        password.keypress(function(event)
        {
            if (event.which == 13)
            {
                event.preventDefault();
                login_btn.click();
            }
        });


        password_reset_errors.hide();
        password_reset_success.hide();

        reset_password_btn.click(function ()
        {
            var form        = $('form#reset_password');

            var args =
            {
                type                : 'post',
                url                 : '{{ route('forgot.request') }}',
                cache               : false,
                dataType            : 'json',
                data                : JSON.stringify(form.serializeObject()),
                success_element     : '#password-reset-success',
                error_element       : '#password-reset-errors',
                display_messages    : true,
                error_modal         : undefined,
                success_modal       : undefined,
                redirect_url        : undefined,
                spinner_element     : 'spinner'
            };

            constructAjax(args);
        });

    });
</script>