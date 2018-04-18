<div class="col-md-12">

    <h2>{{ trans('organisation.create') }}</h2><br>

    <form class="form-horizontal" id="save-organisation-validate" autocomplete="off">

        @include('admin.organisations.field_layout')

        <br>
        <br>

        @include('components.buttons.save')

    </form>

</div>