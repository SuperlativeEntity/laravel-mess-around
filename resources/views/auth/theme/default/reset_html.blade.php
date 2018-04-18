<div id="reset_spinner"></div>
<div id="overlay"></div>

<div class="login">
    <div class="well">
        <div id="logo-container">
            <img src="{{ asset('images/logo.png') }}" title="{{ config('system.name') }}" alt="{{ config('system.name') }}">
        </div>

        <form id="reset_password" method="POST" method="POST" class="margin-bottom-0" autocomplete="off">

            <div id="validation-errors" style="display: none" class="alert alert-danger m-b-0"></div>

            <div id="success-messages" style="display: none" class="alert alert-success m-b-0"></div>

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group m-b-20">
                @include('auth.elements.email_input')
            </div>

            <div class="form-group m-b-20">
                @include('auth.elements.password_input')
            </div>

            <div class="form-group m-b-20">
                @include('auth.elements.password_confirm_input')
            </div>

            <div>
                @include('auth.elements.reset_button')
            </div>

            <div>
                <br>@include('auth.elements.goto_login_link')
            </div>

        </form>
    </div>
</div>