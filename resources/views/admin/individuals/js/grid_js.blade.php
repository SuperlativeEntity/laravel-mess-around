<script>
    $(document).ready(function()
    {
        renderGrid
        ({
            element         : $("#individual_list_grid"),
            url             : '{{ route('admin.individual.list') }}',
            pageSize        : '{{ config('individual.grid_page_size') }}',
            toolbar         :
            [
                @if ($current_user->hasAccess(['admin.individual.create']))
                {
                    name    : "add_individual_btn_btn",
                    template: "{!! Html::grid_add_button(route('admin.individual.create'),trans('individual.create')) !!}",
                },
                @endif
                "excel","pdf"
            ],
            height          : "{{ config('individual.grid_height') }}",
            excel           :
            {
                fileName    : "{{ config('individual.excel_file_name') }}"
            },
            pdf             :
            {
                fileName    : "{{ config('individual.pdf_file_name') }}"
            },
            model_fields    :
            {
                {!! Html::model_columns(config('individual.grid_model_columns')) !!}
            },
            string_operators:
            {
                {!! Html::string_operators(config('grid.string_operators')) !!}
            },
            columns         :
            [
                {!! Html::display_columns(config('individual.grid_display_columns')) !!}
                @if ($current_user->hasAccess(['admin.individual.modify']))
                {
                    title       : "@lang('individual.modify_short')",
                    template    : '<a data-pjax href="{{ route('admin.individual.modify') }}/#=id#">@lang('individual.modify_short')</a>'
                }
                @endif
            ]
        });
    });
</script>