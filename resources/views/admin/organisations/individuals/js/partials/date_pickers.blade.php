birth_date.kendoDatePicker
({
    format: '{{ config('dates.kendo_format') }}'
});

birth_date.bind("focus", function()
{
    $(this).data("kendoDatePicker").open();
});

join_date.kendoDatePicker
({
    format: '{{ config('dates.kendo_format') }}'
});

join_date.bind("focus", function()
{
    $(this).data("kendoDatePicker").open();
});