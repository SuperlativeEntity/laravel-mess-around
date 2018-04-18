<head>
    @include('layouts._partials.meta_tags')
    <title>{{ config('system.title') }}</title>

    @include('layouts._partials.stylesheets_login')
    <script src="{{ asset('js/jquery/jquery.min.js') }}" type="text/javascript"></script>

    @include('analytics.google_analytics')

    <script type="text/javascript">
        $(document).ready(function($)
        {
            $('#accordion').find('.accordion-toggle').click(function()
            {
                $(this).next().slideToggle('fast');
                $(".accordion-content").not($(this).next()).slideUp('fast');
            });
        });
    </script>

    <style>
        .accordion-toggle {cursor: pointer; margin: 0;}
        .accordion-content {display: none;}
        .accordion-content.default {display: block;}
    </style>

    @if (env('GOOGLE_RECAPTCHA_ON_LOGIN'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif

</head>