<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a data-pjax href="{{ route('index') }}"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
            </li>

            @include('admin.users.menu')
            @include('admin.organisations.menu')
            @include('admin.individuals.menu')
            @include('admin.campaigns.menu')

        </ul>

    </div>

</nav>