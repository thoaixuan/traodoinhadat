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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');
mix.styles([
    "public/themes/admin/plugins/fontawesome-free/css/all.min.css",
    "public/themes/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
    "public/themes/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
    "public/themes/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css",
    "public/themes/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css",
    "public/themes/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css",
    "public/themes/admin/plugins/select2/css/select2.min.css",
    "public/themes/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css",
    "public/themes/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css",
    "public/themes/admin/plugins/toastr/toastr.min.css",
    "public/themes/admin/plugins/daterangepicker/daterangepicker.css",
    "public/themes/admin/plugins/summernote/summernote-bs4.min.css",
    "public/themes/admin/plugins/codemirror/codemirror.css",
    "public/themes/admin/plugins/codemirror/theme/monokai.css",
    "public/themes/admin/plugins/simplemde/simplemde.min.css",
    "public/themes/admin/dist/css/adminlte.min.css",
],'public/themes/admin/app/css.css').minify('public/themes/admin/app/css.css').sourceMaps();

mix.scripts([
    "public/themes/admin/plugins/jquery/jquery.min.js",
    "public/themes/admin/plugins/bootstrap/js/bootstrap.bundle.min.js",
    "public/themes/admin/plugins/datatables/jquery.dataTables.min.js",
    "public/themes/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
    "public/themes/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js",
    "public/themes/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js",
    "public/themes/admin/plugins/sweetalert2/sweetalert2.min.js",
    "public/themes/admin/plugins/toastr/toastr.min.js",
    "public/themes/admin/plugins/select2/js/select2.full.min.js",
    "public/themes/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js",
    "public/themes/admin/plugins/moment/moment.min.js",
    "public/themes/admin/plugins/daterangepicker/daterangepicker.js",
    "public/themes/admin/plugins/summernote/summernote-bs4.min.js",
    "public/themes/admin/plugins/codemirror/codemirror.js",
    "public/themes/admin/plugins/codemirror/mode/css/css.js",
    "public/themes/admin/plugins/codemirror/mode/xml/xml.js",
    "public/themes/admin/plugins/codemirror/mode/php/php.js",
    "public/themes/admin/plugins/codemirror/mode/python/python.js",
    "public/themes/admin/plugins/codemirror/mode/sass/sass.js",
    "public/themes/admin/plugins/codemirror/mode/sql/sql.js",
    "public/themes/admin/plugins/codemirror/mode/vbscript/vbscript.js",
    "public/themes/admin/plugins/codemirror/mode/xquery/xquery.js",
    "public/themes/admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js",
    "public/themes/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
    "public/themes/admin/dist/js/adminlte.min.js",
],'public/themes/admin/app/main.js').minify('public/themes/admin/app/main.js').sourceMaps();

mix.styles('public/main/main.css','public/main/main.css').minify('public/main/main.css').sourceMaps();
mix.styles('public/main/main.js','public/main/main.js').minify('public/main/main.js').sourceMaps();

