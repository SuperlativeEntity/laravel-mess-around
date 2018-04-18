<div id="individual_note_spinner"></div>

<form class="form-horizontal" id="save-individual_note-validate" autocomplete="off">

    <input type="hidden" id="linked_to" name="linked_to" value="individual">
    <input type="hidden" id="individual_id" name="individual_id" value="{{ $individual->id }}">
    <input type="hidden" id="note_id" name="note_id">

    <h3 id="individual_note_heading">@lang('individual_note.create')</h3>

    <div class="row">
        <div class="col-md-3">@include('admin.individuals.notes.fields.note_type')</div>
        <div class="col-md-3">@include('admin.individuals.notes.fields.note')</div>
    </div>

    <br>

    <div class="form-group">
        <div class="col-md-9">
            {!! Html::save_button('individual_note_save_btn',trans('button.create')) !!}
            {!! Html::cancel_button('individual_note_cancel_btn',trans('button.cancel')) !!}
        </div>
    </div>

</form>

<span class="label label-default">{{ strtoupper(trans('individual_note.list')) }}  </span>&nbsp;{{ strtoupper(trans('individual_note.click_to_edit')) }}
<div id="individual_note_list_grid"></div>