var buildings_select = $('select[id^="buildings"]');

if (typeof buildings_select != 'undefined')
{
    buildings_select.kendoMultiSelect
    ({
        dataTextField   : "name",
        dataValueField  : "id",
        placeholder     : "@lang('individual.buildings_select')",
        dataSource      :
        {
            transport   :
            {
                read    :
                {
                    dataType: "json",
                    url     : '{{ route('admin.organisation.building.collection') }}/'+'{{ $organisation->id }}'
                }
            }
        }
    });
}