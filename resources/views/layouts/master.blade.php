<!doctype html>

<html lang="en">

    @include('layouts._partials.head')
    @include('layouts._partials.modal_notifications')

    <body>
        <div id="overlay"></div>

        @include('layouts._partials.theme.'.config('system.theme').'.body')

        <script>
            $(function()
            {
                $(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container');
            });
        </script>

    </body>

    @include('layouts._partials.javascript')
    @include('layouts._partials.theme.'.config('system.theme').'.initialize')
    @include('layouts._partials.footer')

</html>