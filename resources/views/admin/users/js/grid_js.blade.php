<script>
$(document).ready(function()
{

    $("#user_list_grid").kendoGrid
    ({
        toolbar:
        [
            @if ($current_user->hasAccess(['admin.user.create']))
            {
                name    : "add_user_btn",
                template: "{!! Html::grid_add_button(route('admin.user.create'),trans('user.create_user')) !!}",
            },
            @endif
            "excel","pdf"
        ],
        excel:
        {
            fileName    : "{{ config('system.excel_file_name') }}",
            filterable  : true,
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
                read: '{{ route('admin.user.list') }}'
            },
            schema:
            {
                model:
                {
                    fields:
                    {
                        first_name  : { type: "string" },
                        last_name   : { type: "string" },
                        email       : { type: "string" }
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
        height      : {{ config('grid.height') }},
        sortable    : {{ config('grid.sortable') }},
        pageable    : {{ config('grid.pageable') }},
        groupable   : {{ config('grid.groupable') }},
        filterable:
        {
            extra: {{ config('grid.filterable_extra') }},
            operators:
            {
                string:
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
                field   : "first_name",
                title   : "@lang('user.first_name')"
            },
            {
                field   : "last_name",
                title   : "@lang('user.last_name')"
            },
            {
                field   : "email",
                title   : "@lang('user.email')"
            },
            @if ($current_user->hasAccess(['admin.user.modify']))
            {
                title   : "@lang('user.modify_user')",
                template: '<a data-pjax href="{{ route('admin.user.modify') }}/#=id#">@lang('user.modify_user')</a>'
            }
            @endif
        ]
    });
});
</script>