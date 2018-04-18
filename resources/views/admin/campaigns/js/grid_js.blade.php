<script>
    $(document).ready(function()
    {
        renderGrid
        ({
            element         : $("#campaign_list_grid"),
            url             : '{{ route('admin.campaign.list') }}',
            pageSize        : '{{ config('campaign.grid_page_size') }}',
            toolbar         :
            [
                @if ($current_user->hasAccess(['admin.campaign.create']))
                {
                    name    : "add_campaign_btn",
                    template: "{!! Html::grid_add_button(route('admin.campaign.create'),trans('campaign.create')) !!}",
                },
                @endif
                "excel","pdf"
            ],
            height          : "{{ config('campaign.grid_height') }}",
            excel           :
            {
                fileName    : "{{ config('campaign.excel_file_name') }}"
            },
            pdf             :
            {
                fileName    : "{{ config('campaign.pdf_file_name') }}"
            },
            model_fields    :
            {
                {!! Html::model_columns(config('campaign.grid_model_columns')) !!}
            },
            string_operators:
            {
                {!! Html::string_operators(config('grid.string_operators')) !!}
            },
            columns         :
            [
                {!! Html::display_columns(config('campaign.grid_display_columns')) !!}
                @if ($current_user->hasAccess(['admin.campaign.modify']))
                {
                    title       : "@lang('campaign.modify_short')",
                    template    : '<a data-pjax href="{{ route('admin.campaign.modify') }}/#=id#">@lang('campaign.modify_short')</a>'
                }
                @endif
            ]
        });
    });
</script>