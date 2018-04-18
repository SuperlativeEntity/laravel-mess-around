@extends('layouts.master')
@section('content')

    @include('components.modal.errors_modal_setup')
    @include('admin.organisations.modify_tabs')
    @include('admin.organisations.js.manage_js')

@endsection