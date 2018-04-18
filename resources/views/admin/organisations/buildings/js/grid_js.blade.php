<script>
    $(document).ready(function()
    {
        renderGrid
        ({
            element         : $("#building_list_grid"),
            url             : '{{ route('admin.organisation.building.list') }}/{{ $organisation->id }}',
            pageSize        : '{{ config('building.grid_page_size') }}',
            toolbar         : ["excel","pdf"],
            height          : "{{ config('building.grid_height') }}",
            excel           :
            {
                fileName    : "{{ config('building.excel_file_name') }}"
            },
            pdf             :
            {
                fileName    : "{{ config('building.pdf_file_name') }}"
            },
            model_fields    :
            {
                {!! Html::model_columns(config('building.grid_model_columns')) !!}
            },
            string_operators:
            {
                {!! Html::string_operators(config('grid.string_operators')) !!}
            },
            columns         :
            [
                {!! Html::display_columns(config('building.grid_display_columns')) !!}
            ]
        });
    });
</script>