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

const
    webpack = require('webpack'),
    // CleanWebpackPlugin = require('clean-webpack-plugin');
    LodashModuleReplacementPlugin = require('lodash-webpack-plugin');

mix.webpackConfig({
    entry: {
        "/js/vendor": ['lodash'],
        "/js/vue": ['vue','vuex','vue-router']
    },
    plugins: [
        // new CleanWebpackPlugin(['public/components','public/fonts']),
        new LodashModuleReplacementPlugin(),
        // new webpack.optimize.CommonsChunkPlugin({
        //     names: ['/js/vue','/js/vendor'],
        // })
    ],
    output: {
        chunkFilename: './components/[name].js'
    },
    optimization: {
        // runtimeChunk: {
        //     name: 'manifest'
        // },
        // splitChunks: {
        //     name() {
        //         return ['/js/vue','/js/vendor'];
        //     },
            // cacheGroups: {
            //     commons: {
            //         test: /[\\/]node_modules[\\/]/,
            //         name: './components/[name].js',
            //         chunks: "all"
            //     }
            // }
        // }
    }
});

mix
    .js('resources/assets/js/admin.js','public/js')
    .sass('resources/assets/sass/admin.scss','public/css')
    .sass('resources/assets/sass/element.scss','public/css');

mix.sass('resources/assets/sass/bootstrap4.scss','public/css');

