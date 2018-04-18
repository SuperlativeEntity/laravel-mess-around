<script>
    $(document).ready(function ()
    {
        @include('admin.organisations.buildings.js.partials.fields')
        @include('admin.organisations.buildings.js.partials.drop_downs')
        @include('admin.organisations.buildings.js.partials.field_attributes')
        @include('admin.organisations.buildings.js.partials.select_record')
        @include('admin.organisations.buildings.js.partials.cancel')
        @include('admin.organisations.buildings.js.partials.form_validation')

        building_name.focus();

        building_save_btn.click(function ()
        {
            if ($(building_form).valid())
            {
                var args =
                {
                    type                    : 'post',
                    url                     : (building_id.val() != '') ? '{{ route('admin.organisation.building.update') }}' : '{{ route('admin.organisation.building.store') }}',
                    cache                   : false,
                    dataType                : 'json',
                    data                    : JSON.stringify(building_form.serializeObject()),
                    success_element         : undefined,
                    error_element           : '#validation-errors',
                    message_type            : 'toast',
                    display_messages        : true,
                    error_modal             : '#alert_modal',
                    success_modal           : undefined,
                    redirect_url            : undefined,
                    inject_content          : 'false',
                    inject_content_type     : undefined,
                    inject_content_route    : undefined,
                    inject_content_element  : undefined,
                    spinner_element         : 'building_spinner',
                    grid                    : building_list_grid,
                    grid_refresh            : true
                };

                constructAjax(args);
            }
        });
    });
</script>