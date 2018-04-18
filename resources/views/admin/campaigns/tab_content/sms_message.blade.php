@include('admin.campaigns.tab_content.js.sms_message_js')

<form class="form-horizontal" id="cleanup-sms-form" autocomplete="off">

    <input type="hidden" id="campaign_id" name="campaign_id" value="{{ $campaign->id }}">

    <div class="row">
        <div class="col-md-4"><textarea id="sms_message" name="sms_message" rows="10" cols="60">{{ $campaign->message }}</textarea></div>
        <div class="col-md-4"><div><span id="remaining">{{ config('sms.first_sms') }}</span>&nbsp;Character<span class="cplural">s</span> Remaining</div><div>Total&nbsp;<span id="messages">1</span>&nbsp;Message<span class="mplural">s</span>&nbsp;<span id="total">0</span>&nbsp;Character<span class="tplural">s</span></div></div>
        <div class="col-md-4"></div>
    </div>

    {!! Html::generate_button('cleanup_sms_message_btn',trans('campaign.update_sms_message')) !!}

</form>