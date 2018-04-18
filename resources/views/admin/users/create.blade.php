@extends('layouts.master')
@section('content')

    @include('components.modal.errors_modal_setup')
    @include('admin.users.create_html')
    @include('admin.users.js.manage_js')

@endsection