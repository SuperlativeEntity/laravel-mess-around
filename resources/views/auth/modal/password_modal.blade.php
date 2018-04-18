<!-- #modal-success -->
<div class="modal fade" id="password_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">@lang('login.forgot_password')</h4>
            </div>

            <div class="modal-body">

                <div class="text-center">
                    <h4>@lang('login.forgot_message')</h4>
                    <div class="panel-body">
                        <div id="spinner"></div>
                        <form id="reset_password" method="POST" class="margin-bottom-0" autocomplete="off">

                            <div id="password-reset-errors" class="alert alert-danger m-b-0">
                            <div style="display: none"></div>
                            </div>

                            <div id="password-reset-success" class="alert alert-success m-b-0">
                                <div style="display: none"></div>
                            </div>

                            <fieldset>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        @include('auth/elements/email_input')
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="reset_password_btn" class="btn btn-success btn-block btn-lg" value="@lang('login.send_password')" type="button">
                                </div>
                            </fieldset>
                        </form>

                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">{{ isset($close_button) ? $close_button : trans('button.close') }}</a>
            </div>

        </div>
    </div>
</div>