document_cancel_btn.click(function ()
{
    document_id.val('');
    document_heading.text('@lang('document.upload')');
    document_cancel_btn.hide();
    document_download_btn.hide();
});