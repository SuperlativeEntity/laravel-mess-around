<div class="form-group">
    <label for="note">{{ trans('individual_note.note') }}</label>
    <textarea class="form-control" rows="10" cols="10" id="note" name="note"></textarea>
    {!! Html::input_add_on(trans('label.required')) !!}
</div>