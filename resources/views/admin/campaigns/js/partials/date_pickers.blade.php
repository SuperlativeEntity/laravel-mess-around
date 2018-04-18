start_date.kendoDatePicker
({
    format: '{{ config('dates.kendo_format') }}'
});

start_date.bind("focus", function()
{
    $(this).data("kendoDatePicker").open();
});