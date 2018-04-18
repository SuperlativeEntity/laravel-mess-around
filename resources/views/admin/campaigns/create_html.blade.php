<div id="campaign_spinner"></div>

<div class="col-md-12">

    <h2>{{ trans('campaign.create') }}</h2><br>

    <form class="form-horizontal" id="save-campaign-validate" autocomplete="off">

        @include('admin.campaigns.field_layout')

        <br>

        <div class="row">
            <div class="col-md-9">
                {!! Html::save_button('save_btn',trans('button.create')) !!}
            </div>
        </div>

    </form>

</div>