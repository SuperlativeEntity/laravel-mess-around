function renderMultiSelect(args)
{
    args['element'].kendoMultiSelect
    ({
        dataTextField   : 'name',
        dataValueField  : 'id',
        dataSource:
        {
            transport:
            {
                read:
                {
                    dataType: 'json',
                    url     : args['url']
                }
            }
        }
    });
}

function destroyMultiSelect(element)
{
    var multiSelect = $(element);

    if (typeof multiSelect != 'undefined' && multiSelect != null)
    {
        var multiSelectData = multiSelect.data("kendoMultiSelect");

        if (typeof multiSelectData != 'undefined' && multiSelectData != null)
        {
            multiSelectData.destroy();
            multiSelectData.wrapper.remove();
        }

        multiSelect.remove();
    }
}