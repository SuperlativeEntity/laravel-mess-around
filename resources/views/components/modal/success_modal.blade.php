<!-- #modal-success -->
<div class="modal fade" id="success_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h4 class="modal-title">{{ isset($success_title) ? $success_title : trans('label.success') }}</h4>
            </div>

            <div class="modal-body">

                <div class="alert alert-success m-b-0">
                    <div id="success-messages" style="display: none"></div>
                </div>

            </div>

            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">{{ isset($close_button) ? $close_button : trans('button.close') }}</a>
            </div>

        </div>
    </div>
</div>