@if ($current_user->hasAccess(['admin.organisation.module']))
    <li>
        <a href="#"><i class="fa fa-group fa-2x"></i>@lang('organisation.plural')<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">

            @if ($current_user->hasAccess(['admin.organisation.create']))
                <li><a data-pjax href="{{ route('admin.organisation.create') }}">@lang('organisation.create')</a></li>
            @endif

            @if ($current_user->hasAccess(['admin.organisation.index']))
                <li><a data-pjax href="{{ route('admin.organisation.index') }}">@lang('organisation.list')</a></li>
            @endif

        </ul>
    </li>
@endif