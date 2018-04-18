@if ($current_user->hasAccess(['admin.individual.module']))
    <li>
        <a href="#"><i class="fa fa-user fa-2x"></i>@lang('individual.plural')<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">

            @if ($current_user->hasAccess(['admin.individual.create']))
                <li><a data-pjax href="{{ route('admin.individual.create') }}">@lang('individual.create')</a></li>
            @endif

            @if ($current_user->hasAccess(['admin.individual.index']))
                <li><a data-pjax href="{{ route('admin.individual.index') }}">@lang('individual.list')</a></li>
            @endif

        </ul>
    </li>
@endif