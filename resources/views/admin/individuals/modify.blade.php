@extends('layouts.master')
@section('content')

    @include('components.modal.errors_modal_setup')
    @include('admin.individuals.modify_tabs')
    @include('admin.individuals.js.manage_js')
    @include('admin.individuals.js.user_account_js')

@endsection