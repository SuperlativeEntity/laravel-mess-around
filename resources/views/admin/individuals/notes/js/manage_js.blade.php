<script>
    $(document).ready(function ()
    {
        @include('admin.individuals.notes.js.partials.fields')
        @include('admin.individuals.notes.js.partials.drop_downs')
        @include('admin.individuals.notes.js.partials.field_attributes')
        @include('admin.individuals.notes.js.partials.select_record')
        @include('admin.individuals.notes.js.partials.cancel')
        @include('admin.individuals.notes.js.partials.form_validation')

        note_type_id.data("kendoDropDownList").focus();

        individual_note_save_btn.click(function ()
        {
            if ($(individual_note_form).valid())
            {
                var args =
                {
                    type                    : 'post',
                    url                     : (note_id.val() != '') ? '{{ route('admin.individual.note.update') }}' : '{{ route('admin.individual.note.store') }}',
                    cache                   : false,
                    dataType                : 'json',
                    data                    : JSON.stringify(individual_note_form.serializeObject()),
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
                    spinner_element         : 'individual_note_spinner',
                    grid                    : individual_note_list_grid,
                    grid_refresh            : true
                };

                constructAjax(args);
            }
        });
    });
</script>