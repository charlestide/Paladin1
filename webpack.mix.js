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
    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/form.js','public/js')
    .js('resources/assets/js/data.js','public/js')
    .js('resources/assets/js/chart.js','public/js')

    .js('resources/assets/js/3rd/blankon/blankon.js','public/js/blankon.js')
    .js('resources/assets/js/3rd/blankon/demo.js','public/js/demo.js')

    .styles([
        'resources/assets/css/3rd/blankon/layout.css',
        'resources/assets/css/3rd/blankon/components.css',
        'resources/assets/css/3rd/blankon/plugins.css',
        'resources/assets/css/3rd/blankon/reset.css',
        'resources/assets/css/app.css'
    ],'public/css/paladin.css')

    .styles([
        'resources/assets/css/3rd/blankon/pages/sign.css',
    ],'public/css/sign.css')

;