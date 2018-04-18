@include('admin.individuals.js.select_update_js')
@include('admin.individuals.js.organisation_grid_js')
@include('admin.individuals.js.organisations_link_js')

<div class="row">

    <h2>@lang('individual.currently_linked_to')</h2>
    <span class="label label-default">@lang('individual.organisation_select')</span>
    <div id="organisation_list_grid"></div>

    <hr>

    <div id="organisation_attributes">
        <h2 id="individual_organisation_header"></h2><br>

        <form class="form-horizontal" id="update-individual-relations" autocomplete="off">

            <input type="hidden" id="organisation_id" name="organisation_id">
            <input type="hidden" id="organisation_type_id" name="organisation_type_id">
            <input type="hidden" id="individual_id" name="individual_id" value="{{ $individual->id }}">

            @include('admin.individuals.fields.roles')
            @include('admin.individuals.fields.buildings')

            <br>

            <div class="row">
                <div class="col-md-9">
                    {!! Html::save_button('update_relations_btn',trans('button.save')) !!}

                    @if ($current_user->hasAccess(['admin.organisation.individual.unlink']))
                        {!! Html::unlink_button('unlink_individual_btn',trans('button.unlink')) !!}
                    @endif

                </div>
            </div>

        </form>

        <hr>

    </div>

    <h2>@lang('individual.link_to')</h2>
    <form class="form-horizontal" id="update-individual-organisations" autocomplete="off">

        <input type="hidden" id="individual_id" name="individual_id" value="{{ $individual->id }}">

        <span class="label label-default">@lang('individual.not_member_of')</span>
        @include('admin.individuals.fields.organisations')

        <br>

        @if ($current_user->hasAccess(['admin.individual.organisation.link']))
            {!! Html::link_button('link_organisation_btn',trans('button.link')) !!}
        @endif

    </form>

</div>