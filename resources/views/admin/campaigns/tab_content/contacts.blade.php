@include('admin.campaigns.tab_content.js.contacts_js')

<form class="form-horizontal" id="cleanup-contacts-form" autocomplete="off">

    <input type="hidden" id="campaign_id" name="campaign_id" value="{{ $campaign->id }}">

    <div class="row">
        <div class="col-md-4"><textarea id="campaign_contacts" name="campaign_contacts" rows="10" cols="60">{{ $campaign->contacts }}</textarea></div>
        <div class="col-md-4"><span class="label label-info">@lang('contact.count')</span><h2 id="contacts_count">{{ $campaign->contacts_count }}</h2></div>
        <div class="col-md-4"></div>
    </div>

    {!! Html::generate_button('cleanup_contacts_btn',trans('campaign.prepare_contacts')) !!}

</form>