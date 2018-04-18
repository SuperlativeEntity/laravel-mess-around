<form class="form-horizontal" id="save-user-validate" autocomplete="off">

    <input type="hidden" id="id" name="id" value="{{ $user->id }}">

    @include('admin.users.fields.email')
    @include('admin.users.fields.first_name')
    @include('admin.users.fields.last_name')
    @include('admin.users.fields.password')
    @include('admin.users.fields.password_confirm')

    <br>

    <div class="form-group">
        <div class="col-md-9">
            {!! Html::save_button('save_btn',trans('button.save')) !!}
        </div>
    </div>

</form>