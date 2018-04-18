@if(isset($modal_arguments))
    @include('components/modal/errors_modal',$modal_arguments)
    @include('components/modal/success_modal',$modal_arguments)
@endif