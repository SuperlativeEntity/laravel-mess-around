<script>
    $(document).ready(function ()
    {
        var organisation_link_form  = $('#update-individual-organisations');
        var organisations           = $('select[id^="organisations"]');
        var link_organisation_btn   = $('#link_organisation_btn');
        var organisation_list_grid  = $("#organisation_list_grid");

        organisations.kendoMultiSelect
        ({
            dataTextField   : "name",
            dataValueField  : "id",
            placeholder     : "@lang('individual.organisations_select')",
            dataSource      :
            {
                transport:
                {
                    read:
                    {
                        dataType    : "json",
                        url         : '{{ route('admin.individual.organisations_no_member',$individual->id) }}'
                    }
                }
            }
        });

        link_organisation_btn.click(function()
        {
            var args =
            {
                type                    : 'post',
                url                     : '{{ route('admin.individual.organisation.link') }}',
                cache                   : false,
                dataType                : 'json',
                data                    : JSON.stringify(organisation_link_form.serializeObject()),
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
                spinner_element         : 'individual_spinner',
                grid                    : organisation_list_grid,
                grid_refresh            : true
            };

            constructAjax(args);
        });

    });
</script>