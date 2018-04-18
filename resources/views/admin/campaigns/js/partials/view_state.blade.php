@if (empty($campaign))
    @include('admin.campaigns.js.partials.drop_downs_create')
@endif

@if (isset($campaign))
    @include('admin.campaigns.js.partials.drop_downs_update')
@endif

campaign_type_id.data("kendoDropDownList").focus();