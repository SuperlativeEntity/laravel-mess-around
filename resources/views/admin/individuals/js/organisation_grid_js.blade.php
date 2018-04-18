<script>
    $(document).ready(function()
    {
        var organisation_list_grid  = $("#organisation_list_grid");

        organisation_list_grid.kendoGrid
        ({
            toolbar: ["excel","pdf"],
            excel:
            {
                fileName    : "{{ config('system.excel_file_name') }}",
                filterable  : true,
                allPages    : true
            },
            pdf:
            {
                allPages    : true,
                fileName    : "{{ config('system.pdf_file_name') }}",
            },
            dataSource:
            {
                transport   :
                {

                    read: '{{ route('admin.individual.organisations',['id'=>$individual->id]) }}'
                },
                schema:
                {
                    model:
                    {
                        fields:
                        {
                            organisation_type                   : { type: "string" },
                            organisation                        : { type: "string" },
                            //organisation_registration_number    : { type: "string" },
                        }
                    },
                    data    : "data",   // records are returned in the "data" field of the response
                    total   : "total"  // total number of records is in the "total" field of the response
                },
                pageSize        : {{ config('individual.organisation_grid_page_size') }},
                serverPaging    : {{ config('grid.serverPaging') }},
                serverFiltering : {{ config('grid.serverFiltering') }},
                serverSorting   : {{ config('grid.serverSorting') }}
            },
            height      : {{ config('individual.organisation_grid_height') }},
            sortable    : {{ config('grid.sortable') }},
            pageable    : {{ config('grid.pageable') }},
            groupable   : {{ config('grid.groupable') }},
            filterable  :
            {
                extra       : {{ config('grid.filterable_extra') }},
                operators   :
                {
                    string  :
                    {
                        contains    : "@lang('grid.contains')",
                        startswith  : "@lang('grid.startswith')",
                        eq          : "@lang('grid.eq')",
                        neq         : "@lang('grid.neq')"
                    }
                }
            },
            selectable: "@lang('grid.selectable')",
            columns:
            [
                {
                    field       : "organisation_id",
                    title       : "organisation_id",
                    hidden      : true,
                    filterable  : false
                },
                {
                    field       : "organisation_type_id",
                    title       : "organisation_type_id",
                    hidden      : true,
                    filterable  : false
                },
                {
                    field       : "organisation_type",
                    title       : "@lang('organisation.organisation_type')"
                },
                {
                    field       : "organisation",
                    title       : "@lang('organisation.name')"
                },
                /*
                {
                    field       : "organisation_registration_number",
                    title       : "@lang('organisation.registration_number')"
                }
                */
            ]
        });
    });
</script>