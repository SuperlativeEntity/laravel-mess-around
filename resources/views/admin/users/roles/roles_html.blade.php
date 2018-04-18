<form class="form-horizontal" id="modify-roles-validate" autocomplete="off">
    
    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">

    @include('admin.users.fields.roles_select')

    <br>

    <div class="form-group">
        <div class="col-md-9">
            {!! Html::save_button('update_roles_btn',trans('button.save')) !!}
        </div>
    </div>

</form>