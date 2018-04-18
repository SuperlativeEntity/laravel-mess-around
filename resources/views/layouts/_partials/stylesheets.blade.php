{{-- use font if connected to the internet. downloaded fonts are huge --}}
{{-- there seems to be no ui delay if not connected to the net --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" >

<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/font-awesome.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/kendo/kendo.common.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/kendo/kendo.custom.css') }}">

@if (config('system.theme') == 'default')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/'.config('system.theme').'/default.css') }}">
@endif

<link rel="stylesheet" type="text/css" href="{{ asset('css/toastr/toastr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom/default.css') }}">