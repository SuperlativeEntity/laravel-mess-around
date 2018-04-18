<script>
    $(document).ready(function ()
    {
        var individual_update_btn = $('#individual_update_btn');

        @include('admin.organisations.individuals.js.partials.fields')
        @include('admin.organisations.individuals.js.partials.field_attributes')
        @include('admin.individuals.js.partials.drop_downs')
        @include('admin.organisations.individuals.js.partials.date_pickers')
        @include('admin.organisations.individuals.js.partials.form_validation')
        @include('admin.individuals.js.partials.store')
        @include('admin.individuals.js.partials.update')
        @include('components.tabs.inject')
    });
</script>