@if (isset($campaign))
<div id="campaign_spinner"></div>

<div class="col-md-12">

    <h2>{{ $campaign->name }}</h2>

    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#modify_basic_info" data-toggle="tab" aria-expanded="true"><i class="fa fa-info"></i>&nbsp;@lang('campaign.singular')</a></li>

            @if ($current_user->hasAccess(['admin.campaign.contacts']))
                <li><a href="#campaign_contacts" data-container="load_campaign_contacts" data-route="{{ route('admin.campaign.contacts',['id' => $campaign->id]) }}" data-toggle="tab" aria-expanded="true"><i class="fa fa-users"></i>@lang('contact.plural')</a></li>
            @endif

            @if ($current_user->hasAccess(['admin.campaign.sms_message']) && (int)$campaign->campaign_type_id === config('campaign.sms'))
                <li><a href="#sms_message" data-container="load_sms_message" data-route="{{ route('admin.campaign.sms_message',['id' => $campaign->id]) }}" data-toggle="tab" aria-expanded="true"><i class="fa fa-envelope"></i>@lang('campaign.sms_message')</a></li>
            @endif
        </ul>

        <div class="tab-content">

            <div class="tab-pane fade active in" id="modify_basic_info">
                @include('admin.campaigns.tab_content.basic_info')
            </div>

            @if ($current_user->hasAccess(['admin.campaign.contacts']))
                <div class="tab-pane fade" id="campaign_contacts">
                    <div id="load_campaign_contacts"></div>
                </div>
            @endif

            @if ($current_user->hasAccess(['admin.campaign.sms_message']) && (int)$campaign->campaign_type_id === config('campaign.sms'))
                <div class="tab-pane fade" id="sms_message">
                    <div id="load_sms_message"></div>
                </div>
            @endif

        </div>
    </div>
</div>
@endif