<div id="individual_spinner"></div>

<div class="col-md-12">

    <h2>{{ trans('individual.create') }}</h2><br>

    <form class="form-horizontal" id="save-individual-validate" autocomplete="off">

        @include('admin.organisations.individuals.field_layout',['include_roles'=>false])

        <br>

        <div class="row">
            <div class="col-md-9">
                {!! Html::save_button('individual_save_btn',trans('button.create')) !!}
            </div>
        </div>

    </form>

</div>