@if ($current_user->hasAccess(['admin.campaign.module']))
    <li>
        <a href="#"><i class="fa fa-user fa-2x"></i>@lang('campaign.plural')<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">

            @if ($current_user->hasAccess(['admin.campaign.create']))
                <li><a data-pjax href="{{ route('admin.campaign.create') }}">@lang('campaign.create')</a></li>
            @endif

            @if ($current_user->hasAccess(['admin.campaign.index']))
                <li><a data-pjax href="{{ route('admin.campaign.index') }}">@lang('campaign.list')</a></li>
            @endif

        </ul>
    </li>
@endif