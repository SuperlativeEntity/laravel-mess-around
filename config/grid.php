<?php

// config('grid.pageSize')
return
[
    'pageSize'          => 20,
    'serverPaging'      => 'true',
    'serverFiltering'   => 'true',
    'serverSorting'     => 'true',
    'height'            => 500,
    'sortable'          => 'true',
    'pageable'          => 'true',
    'groupable'         => 'true',
    'selectable'        => 'single row',
    'filterable_extra'  => 'true',
    'string_operators'  => ['contains','startswith','eq','neq']
];