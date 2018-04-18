<form class="form-horizontal" id="save-campaign-validate" autocomplete="off">

    <input type="hidden" id="campaign_id" name="campaign_id" value="{{ $campaign->id }}">

    @include('admin.campaigns.field_layout')

    <br>

    <div class="row">
        <div class="col-md-9">
            {!! Html::save_button('save_btn',trans('button.save')) !!}
        </div>
    </div>

</form>