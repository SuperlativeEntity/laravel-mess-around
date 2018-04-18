<script>
    $(document).ready(function()
    {

        $("#organisation_list_grid").kendoGrid
        ({
            toolbar:
            [
                @if ($current_user->hasAccess(['admin.organisation.create']))
                {
                    name    : "add_organisation_btn",
                    template: "{!! Html::grid_add_button(route('admin.organisation.create'),trans('organisation.create')) !!}",
                },
                @endif
                "excel","pdf"
            ],
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
                    read: '{{ route('admin.organisation.list') }}'
                },
                schema:
                {
                    model:
                    {
                        fields:
                        {
                            organisation_type   : { type: "string" },
                            name                : { type: "string" },
                            registration_number : { type: "string" },
                            email               : { type: "string" },
                            phone               : { type: "string" },
                        }
                    },
                    data    : "data",   // records are returned in the "data" field of the response
                    total   : "total"  // total number of records is in the "total" field of the response
                },
                pageSize        : {{ config('grid.pageSize') }},
                serverPaging    : {{ config('grid.serverPaging') }},
                serverFiltering : {{ config('grid.serverFiltering') }},
                serverSorting   : {{ config('grid.serverSorting') }}
            },
            height      : {{ config('organisation.grid_height') }},
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
                    field       : "organisation_type",
                    title       : "@lang('organisation.organisation_type')"
                },
                {
                    field       : "name",
                    title       : "@lang('organisation.name')"
                },
                {
                    field       : "registration_number",
                    title       : "@lang('organisation.registration_number')"
                },
                {
                    field       : "deed",
                    title       : "@lang('organisation.deed')"
                },
                @if ($current_user->hasAccess(['admin.organisation.modify']))
                {
                    title       : "@lang('organisation.modify_short')",
                    template    : '<a data-pjax href="{{ route('admin.organisation.modify') }}/#=id#">@lang('organisation.modify_short')</a>'
                }
                @endif
            ]
        });
    });
</script>