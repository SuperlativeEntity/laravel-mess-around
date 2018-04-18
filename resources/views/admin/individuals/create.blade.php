@extends('layouts.master')
@section('content')

    @include('components.modal.errors_modal_setup')
    @include('admin.individuals.create_html')
    @include('admin.individuals.js.manage_js')

@endsection