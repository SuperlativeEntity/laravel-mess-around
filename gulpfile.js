var elixir = require('laravel-elixir');

/*
require('laravel-elixir-vue-2');

elixir((mix) => {
    mix.sass('app.scss')
        .webpack('app.js');
});*/

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix)
{

    // bootstrap
    mix.copy('bower_components/bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap/bootstrap.min.css');
    mix.copy('bower_components/bootstrap/dist/css/bootstrap.min.css.map', 'public/css/bootstrap/bootstrap.min.css.map');
    mix.copy('bower_components/bootstrap/dist/js/bootstrap.min.js', 'public/js/bootstrap/bootstrap.min.js');

    // font awesome
    mix.copy('bower_components/fontawesome/css/font-awesome.min.css', 'public/css/fontawesome/font-awesome.min.css');
    mix.copy('bower_components/fontawesome/fonts', 'public/css/fonts');

    // jquery
    mix.copy('bower_components/jquery/dist/jquery.min.js', 'public/js/jquery/jquery.min.js');
    mix.copy('bower_components/jquery-migrate/jquery-migrate.min.js', 'public/js/jquery/jquery-migrate.min.js');

    // jquery pjax
    mix.copy('bower_components/jquery-pjax/jquery.pjax.js', 'public/js/jquery/jquery.pjax.js');

    // jquery cookie
    mix.copy('bower_components/jquery-cookie/jquery.cookie.js', 'public/js/jquery/jquery.cookie.js');

    // jquery ui
    mix.copy('bower_components/jquery-ui/jquery-ui.min.js', 'public/js/jquery/jquery-ui.min.js');
    mix.copy('bower_components/jquery-ui/themes/base/all.css', 'public/css/jquery/jquery-ui.css');
    mix.copy('bower_components/jquery-ui/themes/base/base.css', 'public/css/jquery/base.css');
    mix.copy('bower_components/jquery-ui/themes/base/theme.css', 'public/css/jquery/theme.css');
    mix.copy('bower_components/jquery-ui/themes/base/core.css', 'public/css/jquery/core.css');

    mix.copy('bower_components/jquery-ui/themes/base/accordion.css', 'public/css/jquery/accordion.css');
    mix.copy('bower_components/jquery-ui/themes/base/autocomplete.css', 'public/css/jquery/autocomplete.css');
    mix.copy('bower_components/jquery-ui/themes/base/button.css', 'public/css/jquery/button.css');
    mix.copy('bower_components/jquery-ui/themes/base/datepicker.css', 'public/css/jquery/datepicker.css');
    mix.copy('bower_components/jquery-ui/themes/base/dialog.css', 'public/css/jquery/dialog.css');
    mix.copy('bower_components/jquery-ui/themes/base/draggable.css', 'public/css/jquery/draggable.css');
    mix.copy('bower_components/jquery-ui/themes/base/menu.css', 'public/css/jquery/menu.css');
    mix.copy('bower_components/jquery-ui/themes/base/progressbar.css', 'public/css/jquery/progressbar.css');
    mix.copy('bower_components/jquery-ui/themes/base/resizable.css', 'public/css/jquery/resizable.css');
    mix.copy('bower_components/jquery-ui/themes/base/selectable.css', 'public/css/jquery/selectable.css');
    mix.copy('bower_components/jquery-ui/themes/base/selectmenu.css', 'public/css/jquery/selectmenu.css');
    mix.copy('bower_components/jquery-ui/themes/base/sortable.css', 'public/css/jquery/sortable.css');
    mix.copy('bower_components/jquery-ui/themes/base/slider.css', 'public/css/jquery/slider.css');
    mix.copy('bower_components/jquery-ui/themes/base/spinner.css', 'public/css/jquery/spinner.css');
    mix.copy('bower_components/jquery-ui/themes/base/tabs.css', 'public/css/jquery/tabs.css');
    mix.copy('bower_components/jquery-ui/themes/base/tooltip.css', 'public/css/jquery/tooltip.css');
    
    mix.copy('bower_components/jquery-validation/dist/jquery.validate.min.js', 'public/js/jquery/jquery.validate.min.js');
    mix.copy('bower_components/jquery-validation/dist/additional-methods.min.js', 'public/js/jquery/additional-methods.min.js');

    // pace loader
    mix.copy('bower_components/pace/pace.min.js', 'public/js/pace/pace.min.js');

    // browser support
    mix.copy('bower_components/html5shiv/dist/html5shiv.min.js', 'public/js/html5shiv/html5shiv.min.js');
    mix.copy('bower_components/respond/dest/respond.min.js', 'public/js/respond/respond.min.js');
    mix.copy('bower_components/excanvas/excanvas.js', 'public/js/excanvas/excanvas.js');

    // slim scroll
    mix.copy('bower_components/slimscroll/jquery.slimscroll.min.js', 'public/js/slimscroll/jquery.slimscroll.min.js');

    // jszip
    mix.copy('bower_components/jszip/dist/jszip.min.js', 'public/js/jszip/jszip.min.js');

    // spinner
    mix.copy('bower_components/spin.js/spin.min.js', 'public/js/spin.js/spin.min.js');

    // toastr notifications
    mix.copy('bower_components/toastr/toastr.min.js', 'public/js/toastr/toastr.min.js');
    mix.copy('bower_components/toastr/toastr.js.map', 'public/js/toastr/toastr.js.map');
    mix.copy('bower_components/toastr/toastr.min.css', 'public/css/toastr/toastr.min.css');

    // icheck
    mix.copy('bower_components/iCheck/icheck.min.js', 'public/js/iCheck/icheck.min.js');
    mix.copy('bower_components/iCheck/skins/square/blue.css', 'public/css/iCheck/skins/square/blue');
    mix.copy('bower_components/iCheck/skins/square/blue.png', 'public/css/iCheck/skins/square/blue');
    mix.copy('bower_components/iCheck/skins/square/blue@2x.png', 'public/css/iCheck/skins/square/blue');

    // hide / show password
    mix.copy('bower_components/hideshowpassword/hideShowPassword.min.js', 'public/js/hideshowpassword/hideShowPassword.min.js');

    // metis menu
    mix.copy('bower_components/metisMenu/dist/metisMenu.min.js', 'public/js/metisMenu/metisMenu.min.js');
    mix.copy('bower_components/metisMenu/dist/metisMenu.js.map', 'public/js/metisMenu/metisMenu.js.map');

    // isotope
    mix.copy('bower_components/isotope/dist/isotope.pkgd.min.js', 'public/js/isotope/isotope.pkgd.min.js');

    // combine all css and js then version them
    /*
    mix.scriptsIn('public/js');
    mix.stylesIn('public/css');
    mix.version(['css/all.css', 'js/all.js']);*/

});