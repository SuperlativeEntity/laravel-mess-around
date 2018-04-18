<div id="individual_spinner"></div>

<div id="individual_link">
    <h3 id="individual_link_heading">@lang('individual.link')</h3>
    <form class="form-horizontal" id="link-individual-validate" autocomplete="off">

        @include('admin.organisations.individuals.fields.organisation_id')

        <div class="input-group">
            <input type="text" class="form-control" id="id_number_link" name="id_number_link" placeholder="@lang('individual.id_number_link')">
            <span class="input-group-btn">
                <button class="btn btn-info" type="button" id="link_individual_btn" name="link_individual_btn"><i class="fa fa-link"></i>&nbsp;@lang('button.link')</button>
            </span>
        </div>

    </form>

    <hr>
</div>

<h3 id="individual_heading">@lang('individual.create')</h3>
<form class="form-horizontal" id="save-individual-validate" autocomplete="off">

    <input type="hidden" id="linked_to" name="linked_to" value="organisation">
    @include('admin.organisations.individuals.fields.organisation_id')
    <input type="hidden" id="individual_organisation_id" name="individual_organisation_id" value="{{ $organisation->id }}">
    <input type="hidden" id="individual_id" name="individual_id">

    <br>

    @include('admin.organisations.individuals.field_layout',['include_roles'=>true])

    <br>

    <div class="row">
        <div class="col-md-9">
            {!! Html::save_button('individual_save_btn',trans('button.create')) !!}
            {!! Html::cancel_button('individual_cancel_btn',trans('button.cancel')) !!}

            @if ($current_user->hasAccess(['admin.organisation.individual.unlink']))
                {!! Html::unlink_button('unlink_individual_btn',trans('button.unlink')) !!}
            @endif
        </div>
    </div>

</form>

<br>

<span class="label label-default">{{ strtoupper(trans('individual.list')) }}  </span>&nbsp;{{ strtoupper(trans('building.click_to_edit')) }}
<div id="individual_list_grid"></div>