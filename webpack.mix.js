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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')

    .scripts([
        'resources/assets/js/vendor/blankon/apps.js',
        'resources/assets/js/vendor/blankon/demo.js',
    ],'public/js/vendor/blankon/apps.js')

    .styles([
        'resources/assets/css/vendor/blankon/layout.css',
        'resources/assets/css/vendor/blankon/components.css',
        'resources/assets/css/vendor/blankon/plugins.css',
        'resources/assets/css/vendor/blankon/reset.css',
        // 'resources/assets/css/vendor/blankon/themes/laravel.theme.css',
    ],'public/css/vendor/blankon/apps.css')
    // .js('resources/assets/js/components/Input.vue','public/js')


;