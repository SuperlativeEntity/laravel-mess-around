@extends('layouts.master')
@section('content')

    @include('components.modal.errors_modal_setup')
    @include('admin.users.modify_tabs')
    @include('admin.users.js.manage_js')

@endsection