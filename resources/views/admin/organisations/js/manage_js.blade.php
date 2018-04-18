<script>
    $(document).ready(function ()
    {
        @include('admin.organisations.js.partials.fields')
        @include('admin.organisations.js.partials.drop_downs')
        @include('admin.organisations.js.partials.field_attributes')
        @include('admin.organisations.js.partials.form_validation')
        @include('admin.organisations.js.partials.save')
        @include('components.tabs.inject')
    });
</script>