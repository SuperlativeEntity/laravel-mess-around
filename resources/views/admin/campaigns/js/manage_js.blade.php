<script>
    $(document).ready(function ()
    {
        @include('admin.campaigns.js.partials.fields')
        @include('admin.campaigns.js.partials.form_validation')
        @include('admin.campaigns.js.partials.date_pickers')
        @include('admin.campaigns.js.partials.view_state')
        @include('admin.campaigns.js.partials.save_data')
        @include('components.tabs.inject')
    });
</script>