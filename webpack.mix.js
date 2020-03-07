const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'public/assets/plugins/bootstrap/css/bootstrap.min.css',
    'public/assets/css/style.css',
    'public/assets/css/icons.css',
    'public/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css',
    'public/assets/plugins/toggle-menu/sidemenu.css',
    'public/assets/plugins/bootstrap-daterangepicker/daterangepicker.css',
    'public/assets/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css',
    'public/assets/plugins/iCheck/all.css',
    'public/assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css',
    'public/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css',
    'public/assets/plugins/select2/select2.css',
    'public/assets/plugins/multipleselect/multiple-select.css',
    'public/assets/plugins/sumoselect/sumoselect.css',
    'public/assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.css',
    'public/assets/css/mystyle.css',
    'public/assets/plugins/morris/morris.css',
    'public/assets/css/toastr.min.css'
], 'public/assets/css/admin.app.css');


mix.scripts([
    'public/assets/js/jquery.min.js',
    'public/assets/js/popper.js',
    'public/assets/plugins/bootstrap/js/bootstrap.min.js',
    'public/assets/js/tooltip.js',
    'public/assets/plugins/rating/jquery.rating-stars.js',
    'public/assets/plugins/nicescroll/jquery.nicescroll.min.js',
    'public/assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js',
    'public/assets/plugins/toggle-menu/sidemenu.js',
    'public/assets/plugins/select2/select2.full.js',
    'public/assets/plugins/inputmask/jquery.inputmask.js',
    'public/assets/plugins/moment/moment.min.js',
    'assets/plugins/bootstrap-daterangepicker/daterangepicker.js',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js',
    'public/assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js',
    'assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js',
    'assets/plugins/sumoselect/jquery.sumoselect.js',
    'public/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js',
    'public/assets/plugins/iCheck/icheck.min.js',
    'public/assets/plugins/multipleselect/multiple-select.js',
    'public/assets/plugins/multipleselect/multi-select.js',
    'public/assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js',
    'public/assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js',

    // 'public/assets/js/forms.js',
    // 'public/assets/js/advancedform.js',

    // 'public/assets/js/jquery.showmore.js',
    'public/assets/plugins/othercharts/jquery.knob.js',
    'public/assets/plugins/othercharts/jquery.sparkline.min.js',
    'public/assets/plugins/Chart.js/dist/Chart.min.js',
    'public/assets/plugins/Chart.js/dist/Chart.extension.js',
    'public/assets/plugins/morris/morris.min.js',
    'public/assets/plugins/morris/raphael.min.js',
    'public/assets/js/sparkline.js',
    'public/assets/js/othercharts.js',
    // 'public/assets/js/dashboard2.js',
    'public/assets/js/scripts.js',
    'public/assets/js/dev.js',
    'public/assets/js/toastr.min.js'
], 'public/assets/js/admin.app.js');


mix.styles([
    'public/assets/web/css/jquery-confirm.min.css',
    'public/assets/web/css/bootstrap.min.css',
    'public/assets/web/css/font-awesome.min.css',
    'public/assets/web/css/select2.css',
    'public/assets/web/css/style.css'
], 'public/assets/web/css/web.app.css');

mix.scripts([
    'public/assets/web/js/jquery.js',
    'public/assets/web/js/bootstrap.bundle.min.js',
    'public/assets/web/js/jquery.progressTimer.min.js',
    'public/assets/web/js/main.js',
    'public/assets/web/js/arrive.js',
    'public/assets/web/js/jquery-confirm.min.js'
], 'public/assets/web/js/web.app.js');
