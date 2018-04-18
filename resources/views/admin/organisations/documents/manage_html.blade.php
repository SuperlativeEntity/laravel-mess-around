<div id="document_spinner"></div>

<form class="form-horizontal" id="save-document-validate" autocomplete="off" enctype="multipart/form-data">

    <input type="hidden" id="linked_to" name="linked_to" value="organisation">
    <input type="hidden" id="organisation_id" name="organisation_id" value="{{ $organisation->id }}">
    <input type="hidden" id="document_id" name="document_id">

    <h3 id="document_heading">@lang('document.upload')</h3>

    <div class="row">
        <div class="col-md-2">@include('admin.organisations.documents.fields.document_type')</div>
        <div class="col-md-4" id="document_uploader"><input id="document_selected" name="document_selected" type="file" class="file"></div>
    </div>

    <br>

    <div class="form-group">
        <div class="col-md-9">
            <a id="document_download_link" href="{{ route('admin.organisation.document.download',['id'=>15]) }}">{!! Html::download_button('document_download_btn',trans('button.download')) !!}</a>
            {!! Html::cancel_button('document_cancel_btn',trans('button.cancel')) !!}
        </div>
    </div>

</form>

<span class="label label-default">{{ strtoupper(trans('document.list')) }}  </span>&nbsp;{{ strtoupper(trans('document.click_to_edit')) }}
<div id="document_list_grid"></div>