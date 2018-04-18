<script>

    /*
     * the idea is to select an organisation from a grid then display the individual's roles and buildings that fall under that organisation. (where applicable)
     * the problem encountered is that not all organisations have associated buildings linked to them.
     * another issue is that an individual can have different buildings assigned according to the organisation.
     *
     * the kendo drop down list data source doesn't seem to be able to be updated dynamically e.g. change the url and request that the control refreshes
     * which means the control needs to be killed and re-created in order to achieve this goal
     */

    $(document).ready(function ()
    {
        // divs containing label and control
        var roles_field                     = $("#roles_field");
        var buildings_field                 = $("#buildings_field");

        // multi-select drop down fields
        var roles                           = $('select[id^="roles"]');
        var buildings                       = $('select[id^="buildings"]');

        // organisation types that can have buildings
        var has_buildings                   = [{{ implode(',',config('organisation.has_buildings')) }}];

        // list of organisations
        var organisation_list_grid          = $("#organisation_list_grid");

        // update the roles and buildings for an individual for an organisation
        var update_relations_btn            = $('#update_relations_btn');
        var unlink_individual_btn           = $('#unlink_individual_btn');

        var organisation_attributes         = $('#organisation_attributes');
        var individual_organisation_header  = $('#individual_organisation_header');

        var update_individuals_relation_form= $('#update-individual-relations');
        var organisation_id                 = $('#organisation_id');
        var organisation_type_id            = $('#organisation_type_id');
        var individual_id                   = $('#individual_id');

        function hideElements()
        {
            roles_field.hide();
            buildings_field.hide();
            update_relations_btn.hide();
            unlink_individual_btn.hide();
            individual_organisation_header.hide();
            organisation_attributes.hide();
        }

        hideElements();

        // if the grid exists
        if (typeof organisation_list_grid != 'undefined' && organisation_list_grid != null)
        {
            // if an item is clicked on the grid
            organisation_list_grid.click(function ()
            {
                buildings_field.hide(); // for when a user switches between organisations

                var view            = $(this).data("kendoGrid");
                var selectedItem    = view.dataItem(view.select());

                if (selectedItem != null && typeof selectedItem != 'undefined' &&
                    selectedItem.hasOwnProperty('organisation_id') &&
                    selectedItem.hasOwnProperty('organisation_type_id') &&
                    parseInt(selectedItem.organisation_id) > 0 &&
                    parseInt(selectedItem.organisation_type_id) > 0)
                {

                    update_relations_btn.show();
                    unlink_individual_btn.show();
                    individual_organisation_header.show();
                    organisation_attributes.show();

                    var organisation_selected = parseInt(selectedItem.organisation_id);
                    var organisation_type     = parseInt(selectedItem.organisation_type_id);

                    // set the hidden field value
                    organisation_id.val(organisation_selected);
                    organisation_type_id.val(organisation_type);

                    // display the organisation name etc.
                    $.ajax
                    ({
                        url         : '{{ route('admin.organisation.record') }}/' + organisation_selected,
                        type        : "GET",
                        dataType    : "json",
                        success: function (data)
                        {
                            individual_organisation_header.text(data.name+' '+data.registration_number);
                        },
                        error: function (xhr, textStatus, thrownError)
                        {
                            console.log(xhr, textStatus, thrownError);
                        }
                    });

                    // only create the roles multi-select if it doesn't exist as yet
                    // the selected roles will differ based on each organisation selected
                    if (typeof roles.data("kendoMultiSelect") == 'undefined')
                    {
                        roles.kendoMultiSelect
                        ({
                            dataTextField   : "name",
                            dataValueField  : "id",
                            placeholder     : "@lang('individual.roles_select')",
                            dataSource      :
                            {
                                transport:
                                {
                                    read:
                                    {
                                        dataType    : "json",
                                        url         : '{{ route('admin.role.filtered.list') }}' // list of roles excluding admin role
                                    }
                                }
                            }
                        });
                    }

                    // populate the roles assigned to the individual for the specific organisation
                    $.ajax
                    ({
                        // request an array of role ids
                        url         : '{{ route('admin.organisation.individual.role_ids') }}/' + organisation_selected + '/' + '{{ $individual->id }}',
                        type        : "GET",
                        dataType    : "json",
                        success: function (data)
                        {
                            // clear the current roles selected
                            roles.data("kendoMultiSelect").value([]);

                            // if there are no roles, set to an empty array
                            if (data.roles.length == 0)
                                roles.data("kendoMultiSelect").value([]);

                            // if the individual has roles, set those roles
                            if (data.roles.length > 0)
                                roles.data("kendoMultiSelect").value(data.roles);
                        },
                        error: function (xhr, textStatus, thrownError)
                        {
                            console.log(xhr, textStatus, thrownError);
                        }
                    });

                    roles_field.show();

                    // if the organisation has buildings to assign (normally only sectional title and home owners associations can have buildings)
                    if (jQuery.inArray(organisation_type, has_buildings) > -1)
                    {
                        $.ajax
                        ({
                            url         : '{{ route('admin.organisation.building.collection.count') }}/' + organisation_selected,
                            type        : "GET",
                            dataType    : "json",
                            success: function (data)
                            {
                                loadBuildings(data); // try display and load associated buildings
                            },
                            error: function (xhr, textStatus, thrownError)
                            {
                                console.log(xhr, textStatus, thrownError);
                            }
                        });
                    }

                    function loadBuildings(data)
                    {
                        // hide if no buildings are available
                        if (parseInt(data.count) === 0)
                            buildings_field.hide();

                        // display if buildings are available
                        if (parseInt(data.count) > 0)
                        {
                            // NOTE: when swapping between organisations, the list of buildings needs to change for the organisation selected
                            // one cannot simply just update the data source url and reload the data source
                            // the entire control needs to be demolished and re-created, converted into a multi-select again with the updated data source
                            // then the individuals selection needs to be set
                            if (typeof buildings.data("kendoMultiSelect") != 'undefined')
                            {
                                destroyMultiSelect('select[id^="buildings"]');

                                // append a new instance
                                buildings_field.append('<select id="buildings" name="buildings" multiple></select>');

                                // convert the new instance into a multi-select
                                var newBuildingSelect = $('select[id^="buildings"]');

                                newBuildingSelect.kendoMultiSelect
                                ({
                                    dataTextField   : "name",
                                    dataValueField  : "id",
                                    placeholder     : "@lang('individual.buildings_select')",
                                    dataSource      :
                                    {
                                        transport:
                                        {
                                            read:
                                            {
                                                dataType: "json",
                                                url     : '{{ route('admin.organisation.building.collection') }}/' + organisation_selected
                                            }
                                        }
                                    }
                                });

                                // populate the new instance with the individual's selection
                                $.ajax
                                ({
                                    url         : '{{ route('admin.organisation.individual.building_ids') }}/' + organisation_selected + '/' + '{{$individual->id}}',
                                    type        : "GET",
                                    dataType    : "json",
                                    success: function (data)
                                    {
                                        if (data.buildings.length == 0)
                                            newBuildingSelect.data("kendoMultiSelect").value([]);

                                        if (data.buildings.length > 0)
                                            newBuildingSelect.data("kendoMultiSelect").value(data.buildings);
                                    }
                                });
                            }

                            // first time rendering of the multi-select
                            if (typeof buildings.data("kendoMultiSelect") == 'undefined')
                            {
                                buildings.kendoMultiSelect
                                ({
                                    dataTextField   : "name",
                                    dataValueField  : "id",
                                    placeholder     : "@lang('individual.buildings_select')",
                                    dataSource      :
                                    {
                                        transport:
                                        {
                                            read:
                                            {
                                                dataType: "json",
                                                url     : '{{ route('admin.organisation.building.collection') }}/' + organisation_selected
                                            }
                                        }
                                    }
                                });

                                $.ajax
                                ({
                                    url         : '{{ route('admin.organisation.individual.building_ids') }}/' + organisation_selected + '/' + '{{$individual->id}}',
                                    type        : "GET",
                                    dataType    : "json",
                                    success     : function (data)
                                    {
                                        if (data.buildings.length == 0)
                                            buildings.data("kendoMultiSelect").value([]);

                                        if (data.buildings.length > 0)
                                            buildings.data("kendoMultiSelect").value(data.buildings);
                                    }
                                });
                            }

                            buildings_field.show();

                        } // if (parseInt(data.count) > 0)
                    } // function loadBuildings(data)
                } // if (typeof selectedItem != 'undefined' && typeof selectedItem.organisation_id != 'undefined' && selectedItem != null && selectedItem.organisation_id != null && parseInt(selectedItem.organisation_id) > 0)
            }); // organisation_list_grid.click(function()
        } // if (typeof organisation_list_grid != 'undefined' && organisation_list_grid != null)

        update_relations_btn.click(function()
        {
            var args =
            {
                type                    : 'post',
                url                     : '{{ route('admin.individual.relations.update') }}',
                cache                   : false,
                dataType                : 'json',
                data                    : JSON.stringify(update_individuals_relation_form.serializeObject()),
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
                grid                    : undefined,
                grid_refresh            : false
            };

            constructAjax(args);
        });

        unlink_individual_btn.click(function ()
        {
            var unlinkObject    = { organisation_id:organisation_id.val(), individual_id:individual_id.val() };

            var args =
            {
                type                    : 'post',
                url                     : '{{ route('admin.organisation.individual.unlink') }}',
                cache                   : false,
                dataType                : 'json',
                data                    : JSON.stringify(unlinkObject),
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

            if (confirm('@lang('individual.unlink_confirm')'))
            {
                constructAjax(args);
                hideElements();
            }
        });

    });
</script>