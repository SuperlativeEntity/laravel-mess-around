<div class="col-md-12">
    <h2>{!! Html::user_heading($user) !!}</h2>

    <div id="user_spinner"></div>

    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">

            <li class="active"><a href="#modify_basic" data-toggle="tab" aria-expanded="true">@lang('user.basic_information')</a></li>

            @if ($current_user->hasAccess(['admin.user.assign_roles']))
                <li class=""><a href="#modify_roles" data-toggle="tab" aria-expanded="false">@lang('role.roles')</a></li>
            @endif

        </ul>

        <div class="tab-content">

            <div class="tab-pane fade active in" id="modify_basic">
                @include('admin.users.modify_basic')
            </div>

            @if ($current_user->hasAccess(['admin.user.assign_roles']))
                <div class="tab-pane fade" id="modify_roles">
                    @include('admin.users.roles.roles')
                </div>
            @endif

        </div>
    </div>
</div>