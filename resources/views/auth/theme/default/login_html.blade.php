<div id="spinner"></div>
<div id="overlay"></div>

<div class="login">
    <div class="well">

        <div id="logo-container">
            <img src="{{ asset('images/logo.png') }}" title="{{ config('system.name') }}" alt="{{ config('system.name') }}">
        </div>

        <ul class="nav nav-tabs">
            <li class="active"><a href="#login" data-toggle="tab">@lang('login.sign_in')</a></li>
            <li><a href="#forgot_password" data-toggle="tab">@lang('login.forgot_password')</a></li>
        </ul>

        <div id="myTabContent" class="tab-content">

            <div class="tab-pane active in" id="login"><br>
                <form id="login" method="POST" autocomplete="off">

                    <div id="validation-errors" style="display: none" class="alert alert-danger m-b-0"></div>

                    <div class="form-group input-group">
                        @include('auth.elements.email_input')
                    </div>

                    <div class="form-group input-group">
                        @include('auth.elements.password_input')
                    </div>

                    <div class="form-group">
                        <button type="button" id="login_btn" name="login_btn" class="btn btn-primary btn-block">@lang('login.sign_in')</button>
                        @if (env('ENABLE_FACEBOOK_LOGIN'))
                            <br>
                            <a href="{{ route('auth.facebook') }}"><i class="fa fa-facebook"></i>&nbsp;@lang('login.facebook')</a>
                        @endif
                    </div>

                    @if (env('GOOGLE_RECAPTCHA_ON_LOGIN'))
                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                    @endif

                </form>
            </div>

            <div class="tab-pane fade" id="forgot_password"><br>
                <form id="reset_password" method="POST" class="margin-bottom-0" autocomplete="off">

                    <div id="password-reset-errors" class="alert alert-danger m-b-0">
                        <div style="display: none"></div>
                    </div>

                    <div id="password-reset-success" class="alert alert-success m-b-0">
                        <div style="display: none"></div>
                    </div>

                    <div id="accordion">
                        <h5 class="accordion-toggle"><i class="fa fa-info-circle"></i>&nbsp;@lang('reset.reset_instruction_heading')</h5>
                        <div class="accordion-content">
                            <p><small>1.&nbsp;@lang('reset.reset_instruction1')</small></p>
                            <p><small>2.&nbsp;@lang('reset.reset_instruction2') {{ config('system.reply_email') }}.</small></p>
                            <p><small>3.&nbsp;@lang('reset.reset_instruction3')</small></p>
                            <p><small>4.&nbsp;@lang('reset.reset_instruction4')</small></p>
                        </div>
                    </div>

                    <div class="form-group input-group">
                        @include('auth.elements.email_input')
                    </div>

                    <div class="form-group">
                        <input id="reset_password_btn" class="btn btn-primary btn-block" value="@lang('login.send_password')" type="button">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>