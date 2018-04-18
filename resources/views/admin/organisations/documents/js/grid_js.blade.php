<script>
    $(document).ready(function()
    {
        renderGrid
        ({
            element         : $("#document_list_grid"),
            url             : '{{ route('admin.organisation.document.list') }}/{{ $organisation->id }}',
            pageSize        : '{{ config('document.grid_page_size') }}',
            toolbar         : ["excel","pdf"],
            height          : "{{ config('document.grid_height') }}",
            excel           :
            {
                fileName    : "{{ config('document.excel_file_name') }}"
            },
            pdf             :
            {
                fileName    : "{{ config('document.pdf_file_name') }}"
            },
            model_fields    :
            {
                {!! Html::model_columns(config('document.grid_model_columns')) !!}
            },
            string_operators:
            {
                {!! Html::string_operators(config('grid.string_operators')) !!}
            },
            columns         :
            [
                {!! Html::display_columns(config('document.grid_display_columns')) !!}
            ]
        });
    });
</script>