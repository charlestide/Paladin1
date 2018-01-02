let mix = require('laravel-mix');

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
                include: [path.resolve('src'), path.resolve('test'), path.resolve('node_modules/vue-echarts-v3/src')]
            }
        ]
    }
});

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


mix
    .js('assets/js/app.js', 'public/js')
    .js('assets/js/form.js','public/js')
    .js('assets/js/data.js','public/js')
    .js('assets/js/chart.js','public/js')

    .scripts([
        'assets/js/vendor/blankon/apps.js',
        'assets/js/vendor/blankon/demo.js',
    ],'public/js/blankon.js')

    .styles([
        'assets/css/vendor/blankon/layout.css',
        'assets/css/vendor/blankon/components.css',
        'assets/css/vendor/blankon/plugins.css',
        'assets/css/vendor/blankon/reset.css',
        // 'assets/css/vendor/blankon/themes/laravel.theme.css',
        'assets/css/app.css'
    ],'public/css/paladin.css')

    .setPublicPath('public')
;