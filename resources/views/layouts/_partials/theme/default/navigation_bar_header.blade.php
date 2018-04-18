<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a data-pjax class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('images/logo_nav.png') }}" title="{{ config('system.name') }}" alt="{{ config('system.name') }}" class="img-responsive" style="margin-top: -10px;margin-left: 10px"></a>
    </div>
    <div style="color: white; padding: 15px 5px 5px 50px; float: right; font-size: 16px;">@if (isset($current_user)) {{ $current_user->first_name.' '.$current_user->last_name }} @endif &nbsp; <i id="hourglass-user-active" class="fa fa-hourglass-start" style="display: none"></i> <i id="hourglass-user-idle" class="fa fa-hourglass-half" style="display: none"></i> <i id="hourglass-user-session-expired" class="fa fa-hourglass-end" style="display: none"></i> &nbsp;&nbsp;<a href="{{ route('auth.logout') }}" class="btn btn-danger square-btn-adjust">Logout</a> </div>
</nav>