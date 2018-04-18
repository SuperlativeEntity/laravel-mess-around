<script>
    $(document).ready(function()
    {
        renderGrid
        ({
            element         : $("#individual_note_list_grid"),
            url             : '{{ route('admin.individual.note.list') }}/{{ $individual->id }}',
            pageSize        : '{{ config('individual_note.grid_page_size') }}',
            toolbar         : ["excel","pdf"],
            height          : "{{ config('individual_note.grid_height') }}",
            excel           :
            {
                fileName    : "{{ config('individual_note.excel_file_name') }}"
            },
            pdf             :
            {
                fileName    : "{{ config('individual_note.pdf_file_name') }}"
            },
            model_fields    :
            {
                {!! Html::model_columns(config('individual_note.grid_model_columns')) !!}
            },
            string_operators:
            {
                {!! Html::string_operators(config('grid.string_operators')) !!}
            },
            columns         :
            [
                {!! Html::display_columns(config('individual_note.grid_display_columns')) !!}
            ]
        });
    });
</script>