
(function ($)
{
    "use strict";

    var mainApp =
    {

        main: function ()
        {

            $('#main-menu').metisMenu();

            $(window).bind("load resize", function ()
            {
                if ($(this).width() < 600)
                {
                    $('div.sidebar-collapse').addClass('collapse')
                }
                else
                {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });

        }

    };


    $(document).ready(function ()
    {
        mainApp.main();
    });

}(jQuery));
