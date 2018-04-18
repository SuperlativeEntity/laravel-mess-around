<script>
    $(document).ready(function ()
    {
        var reset_password_btn  = $('#reset_password_btn');
        var alert_modal         = $('#alert_modal');
        var success_modal       = $('#success_modal');

        reset_password_btn.click(function ()
        {
            var form        = $('form#reset_password');

            var args =
            {
                type                : 'post',
                url                 : '{{ route('reset.request') }}',
                cache               : false,
                dataType            : 'json',
                data                : JSON.stringify(form.serializeObject()),
                success_element     : '#success-messages',
                error_element       : '#validation-errors',
                display_messages    : true,
                error_modal         : undefined,
                success_modal       : undefined,
                redirect_url        : undefined,
                spinner_element     : 'reset_spinner'
            };

            constructAjax(args);
        });

    });
</script>