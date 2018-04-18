<head>
    @include('layouts._partials.meta_tags')
    <title>{{ config('system.title') }}</title>
    @include('layouts._partials.stylesheets')

    <script src="{{ asset('js/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/kendo/kendo.web.min.js') }}" type="text/javascript"></script>

    @include('analytics.google_analytics')

</head>