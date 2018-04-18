// roles
roles.kendoMultiSelect
({
    dataTextField   : "name",
    dataValueField  : "id",
    placeholder     : "@lang('individual.roles_select')",
    dataSource      :
    {
        transport   :
        {
            read    :
            {
                dataType: "json",
                url     : '{{ route('admin.role.filtered.list') }}'
            }
        }
    }
});