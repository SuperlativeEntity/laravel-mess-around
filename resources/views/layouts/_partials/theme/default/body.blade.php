<div id="wrapper">

    @include('layouts._partials.theme.'.config('system.theme').'.navigation_bar_header')
    @include('layouts._partials.theme.'.config('system.theme').'.side_bar')

    <div id="page-wrapper" >
        <div id="page-inner">
            @include('layouts._partials.theme.'.config('system.theme').'.content')
        </div>
    </div>
</div>
