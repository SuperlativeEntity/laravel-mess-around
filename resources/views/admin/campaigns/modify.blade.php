@extends('layouts.master')
@section('content')

    @include('components.modal.errors_modal_setup')
    @include('admin.campaigns.tabs')
    @include('admin.campaigns.js.manage_js')

@endsection