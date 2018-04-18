<script>
    $(document).ready(function ()
    {
        @include('admin.organisations.documents.js.partials.fields')
        @include('admin.organisations.documents.js.partials.drop_downs')

        @include('admin.organisations.documents.js.partials.document_upload')

        @include('admin.organisations.documents.js.partials.field_attributes')
        @include('admin.organisations.documents.js.partials.select_record')
        @include('admin.organisations.documents.js.partials.cancel')

        document_type_id.data("kendoDropDownList").focus();
    });
</script>