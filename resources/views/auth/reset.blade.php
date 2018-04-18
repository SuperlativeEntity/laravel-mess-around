@extends('layouts.login')
@section('content')

    @include('layouts._partials.javascript')
    @include('layouts._partials.theme.'.config('system.theme').'.initialize')

    @include('auth.reset_js')
    @include('auth.theme.'.config('system.theme').'.reset_html')

    @include('components.modal.errors_modal',
    [
        'title' => trans('reset.failed'),
    ])

    @include('components.modal.success_modal',
    [
        'title' => trans('reset.reset_password'),
    ])

@endsection