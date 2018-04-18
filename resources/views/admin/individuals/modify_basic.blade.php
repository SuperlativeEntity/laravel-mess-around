<form class="form-horizontal" id="save-individual-validate" autocomplete="off">

    <input type="hidden" id="individual_id" name="individual_id" value="{{ $individual->id }}">

    @include('admin.organisations.individuals.field_layout',['include_roles'=>false])

    <br>
    <br>

    <div class="row">
        <div class="col-md-9">
            {!! Html::save_button('individual_update_btn',trans('button.save')) !!}

            @if (empty($individual->user_id) && $current_user->hasAccess(['admin.individual.account.create']) && config('system.individuals_can_login'))
                {!! Html::generate_button('create_account_btn',trans('individual.account_create')) !!}
            @endif
        </div>
    </div>

</form>