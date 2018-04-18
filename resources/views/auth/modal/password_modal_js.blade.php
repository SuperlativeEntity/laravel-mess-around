<script>
    $(document).ready(function ()
    {
        var reset_password_btn      = $('#reset_password_btn');

        var password_reset_errors   = $("#password-reset-errors");
        var password_reset_success  = $("#password-reset-success");

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