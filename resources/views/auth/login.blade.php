@extends('layouts.login')
@section('content')

    @include('layouts._partials.javascript')
    @include('layouts._partials.theme.'.config('system.theme').'.initialize')

    @include('auth.login_js')
    @include('auth.theme.'.config('system.theme').'.login_html')

@endsection