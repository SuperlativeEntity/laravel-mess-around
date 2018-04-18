<script>
    $(document).ready(function()
    {
        renderGrid
        ({
            element         : $("#individual_list_grid"),
            url             : '{{ route('admin.organisation.individual.list') }}/{{ $organisation->id }}',
            pageSize        : '{{ config('individual.grid_page_size') }}',
            toolbar         : ["excel","pdf"],
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
            ]
        });
    });
</script>