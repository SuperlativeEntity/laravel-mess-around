function renderDropDown(args)
{
    args['element'].kendoDropDownList
    ({
        optionLabel     : args['option'],
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
        },
        value:
        [
            args['selected_item']
        ]
    });

    var dropDown    = args['element'].data("kendoDropDownList");

    if (dropDown != undefined)
    {
        var wrapper = args['element'].data("kendoDropDownList").wrapper;

        wrapper.keydown(function (e)
        {
            if (e.keyCode == 13) // enter
            {
                dropDown.open();
            }
        });
    }

}