<!-- #modal-alert -->
<div class="modal fade" id="alert_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">{{ isset($error_title) ? $error_title : trans('label.errors') }}</h4>
            </div>

            <div class="modal-body">

                <div class="alert alert-danger m-b-0">
                    <h4><i class="fa fa-info-circle"></i> {{ isset($error_label) ? $error_label : trans('label.errors') }}</h4>
                    <div id="validation-errors" style="display: none"></div>
                </div>

            </div>

            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">{{ isset($close_button) ? $close_button : trans('button.close') }}</a>
            </div>

        </div>
    </div>
</div>