@if ($current_user->hasAccess(['admin.user.module']))
    <li>
        <a href="#"><i class="fa fa-unlock-alt fa-3x"></i>@lang('user.users')<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">

            @if ($current_user->hasAccess(['admin.user.create']))
                <li><a data-pjax href="{{ route('admin.user.create') }}">@lang('user.create_user')</a></li>
            @endif

            @if ($current_user->hasAccess(['admin.user.index']))
                <li><a data-pjax href="{{ route('admin.user.index') }}">@lang('user.list')</a></li>
            @endif

        </ul>
    </li>
@endif