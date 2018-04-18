mobile.forceNumericOnly();
mobile_secondary.forceNumericOnly();
home.forceNumericOnly();
work.forceNumericOnly();

mobile.attr('maxlength','{{ config('system.phone_number_length') }}');
mobile_secondary.attr('maxlength','{{ config('system.phone_number_length') }}');
home.attr('maxlength','{{ config('system.phone_number_length') }}');
work.attr('maxlength','{{ config('system.phone_number_length') }}');