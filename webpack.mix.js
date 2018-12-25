let mix = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    // .styles([
    //     // 'node_modules/bootstrap/dist/css/bootstrap.min.css',
    //     'public/css/app.css',
    //     // 'resources/assets/adminLTE/font-awesome/css/font-awesome.min.css',
    //     // 'resources/assets/adminLTE/Ionicons/css/ionicons.min.css',
    //     // 'resources/assets/adminLTE/css/AdminLTE.min.css',
    //     // 'resources/assets/adminLTE/css/skins/skin-blue.min.css',
    // ], 'public/css/all.css', './')
    // .scripts([
    //     // 'node_modules/jquery/dist/jquery.min.js',
    //     // 'node_modules/bootstrap/dist/js/bootstrap.min.js',
    //     // 'resources/assets/adminLTE/js/adminlte.min.js'
    // ], 'public/js/app.js', './');
    