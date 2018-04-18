<script src="{{ asset('js/jquery/jquery-migrate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>

<!--[if lt IE 9]>
<script src="{{ asset('js/html5shiv/html5shiv.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/respond/respond.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/excanvas/excanvas.js') }}" type="text/javascript"></script>
<![endif]-->

<script src="{{ asset('js/slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery/jquery.cookie.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/jquery/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery/additional-methods.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/theme/'.config('system.theme').'/app.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/jszip/jszip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery/jquery.pjax.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/spin.js/spin.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/hideshowpassword/hideShowPassword.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/custom/ajax.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom/utilities.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom/validate.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom/drop_down.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom/multi_select.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom/grid.js') }}" type="text/javascript"></script>

@if (env('ENABLE_ECHO') == 'true')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom/echo.js') }}" type="text/javascript"></script>
@endif

@if (config('system.theme') == 'default')
    <script src="{{ asset('js/metisMenu/metisMenu.min.js') }}" type="text/javascript"></script>
@endif

<script>
    var login_url = '{{ $login_url or null }}';

    $.ajaxSetup
    ({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @include('layouts._partials.session_expiry');
</script>