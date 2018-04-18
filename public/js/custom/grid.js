function renderGrid(args)
{
    args['element'].kendoGrid
    ({
        toolbar         : (typeof args['toolbar'] != 'undefined') ? args['toolbar'] : [],
        excel           :
        {
            fileName    : (typeof args['excel']['fileName'] != 'undefined') ? args['excel']['fileName'] : 'data.xlsx',
            filterable  : (typeof args['excelFilterable'] != 'undefined') ? args['excelFilterable'] : true,
            allPages    : (typeof args['excelAllPages'] != 'undefined') ? args['excelAllPages'] : true
        },
        pdf:
        {
            allPages    : (typeof args['pdfAllPages'] != 'undefined') ? args['pdfAllPages'] : true,
            fileName    : (typeof args['pdf']['fileName'] != 'undefined') ? args['pdf']['fileName'] : 'data.pdf'
        },
        dataSource:
        {
            transport   :
            {
                read    : args['url']
            },
            schema:
            {
                model:
                {
                    fields: args['model_fields']
                },
                data    : "data", // records are returned in the "data" field of the response
                total   : "total" // total number of records is in the "total" field of the response
            },
            pageSize        : (typeof args['pageSize'] != 'undefined') ? args['pageSize'] : false,
            serverPaging    : (typeof args['serverPaging'] != 'undefined') ? args['serverPaging'] : false,
            serverFiltering : (typeof args['serverFiltering'] != 'undefined') ? args['serverFiltering'] : false,
            serverSorting   : (typeof args['serverSorting'] != 'undefined') ? args['serverSorting'] : false
        },
        height      : (typeof args['height'] != 'undefined') ? args['height'] : 275,
        sortable    : (typeof args['sortable'] != 'undefined') ? args['sortable'] : true,
        pageable    : (typeof args['pageable'] != 'undefined') ? args['pageable'] : true,
        groupable   : (typeof args['groupable'] != 'undefined') ? args['groupable'] : true,
        selectable  : (typeof args['selectable'] != 'undefined') ? args['selectable'] : true,
        filterable  :
        {
            extra       : (typeof args['filterableExtra'] != 'undefined') ? args['filterableExtra'] : true,
            operators   :
            {
                string  : args['string_operators']
            }
        },
        columns     : args['columns']
    });
}