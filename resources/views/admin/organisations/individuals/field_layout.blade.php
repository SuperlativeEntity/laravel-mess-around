<div class="row">
    <div class="col-md-4">@include('admin.organisations.individuals.fields.title')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.language')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.nationality')</div>
</div>

<br>

<div class="row">
    <div class="col-md-4">@include('admin.organisations.individuals.fields.initials')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.first_name')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.last_name')</div>
</div>

<br>

<div class="row">
    <div class="col-md-4">@include('admin.organisations.individuals.fields.id_number')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.birth_date')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.join_date')</div>
</div>

<br>

<span class="label label-info">Contact Numbers must include international dialing codes</span>

<div class="row">
    <div class="col-md-4">@include('admin.organisations.individuals.fields.email')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.mobile')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.home')</div>
</div>

<br>

<div class="row">
    <div class="col-md-4">@include('admin.organisations.individuals.fields.email_secondary')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.mobile_secondary')</div>
    <div class="col-md-4">@include('admin.organisations.individuals.fields.communication')&nbsp;@include('admin.organisations.individuals.fields.newsletter')<br></div>
</div>

<br>

<div class="row">
    <div class="col-md-4">@include('admin.organisations.individuals.fields.building')</div>
    <div class="col-md-4">@if(isset($include_roles) && $include_roles)@include('admin.organisations.individuals.fields.roles')@endif</div>
    <div class="col-md-4">&nbsp;</div>
</div>