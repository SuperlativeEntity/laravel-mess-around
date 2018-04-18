// when a tab is clicked, only then is the content requested and injected
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e)
{
    var route_attr       = $(e.target).attr("data-route");
    var container_attr   = $(e.target).attr("data-container");
    var container        = $('#'+container_attr);

    // only load the content if the div is empty
    if (typeof route_attr != 'undefined' && container.children().length == 0)
    {
        $.get(route_attr, function (data)
        {
            container.html(data);
        });
    }
});