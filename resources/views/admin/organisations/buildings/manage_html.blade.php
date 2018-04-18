<div id="building_spinner"></div>

<form class="form-horizontal" id="save-building-validate" autocomplete="off">

    <input type="hidden" id="linked_to" name="linked_to" value="organisation">
    <input type="hidden" id="organisation_id" name="organisation_id" value="{{ $organisation->id }}">
    <input type="hidden" id="building_id" name="building_id">

    <h3 id="building_heading">@lang('building.create')</h3>

    <div class="row">
        <div class="col-md-3">@include('admin.organisations.buildings.fields.name')</div>
        <div class="col-md-3">@include('admin.organisations.buildings.fields.erf')</div>
        <div class="col-md-3">@include('admin.organisations.buildings.fields.valuation_amount')</div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-3">@include('admin.organisations.buildings.fields.province')</div>
        <div class="col-md-3">@include('admin.organisations.buildings.fields.district')</div>
        <div class="col-md-3">@include('admin.organisations.buildings.fields.valcon_registered')</div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-3">@include('admin.organisations.buildings.fields.valcon_number')</div>
        <div class="col-md-3">@include('admin.organisations.buildings.fields.address')</div>
        <div class="col-md-3">&nbsp;</div>
    </div>

    <br>

    <div class="form-group">
        <div class="col-md-9">
            {!! Html::save_button('building_save_btn',trans('button.create')) !!}
            {!! Html::cancel_button('building_cancel_btn',trans('button.cancel')) !!}
        </div>
    </div>

</form>

<span class="label label-default">{{ strtoupper(trans('building.list')) }}  </span>&nbsp;{{ strtoupper(trans('building.click_to_edit')) }}
<div id="building_list_grid"></div>