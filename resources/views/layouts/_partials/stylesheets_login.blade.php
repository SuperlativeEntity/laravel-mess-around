{{-- use font if connected to the internet. downloaded fonts are huge --}}
{{-- there seems to be no ui delay if not connected to the net --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" >

<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/font-awesome.min.css') }}">

@if (config('system.theme') == 'default')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/'.config('system.theme').'/login.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/'.config('system.theme').'/button.css') }}">
@endif