let mix = require('laravel-mix');
const
    webpack = require('webpack'),
    CleanWebpackPlugin = require('clean-webpack-plugin'),
    BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin,
    UglifyJsPlugin = require('uglifyjs-webpack-plugin'),
    LodashModuleReplacementPlugin = require('lodash-webpack-plugin');

mix.webpackConfig({
    entry: {
        "/js/vendor": ['lodash'],
        "/js/vue": ['vue','vuex','vue-router']
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
                include: [
                    path.resolve('resource/assets/js'),
                    // require.resolve('bootstrap-vue')
                ],
                options: {
                    plugins: ['lodash'],
                }
            },
            // {
            //     test: /\.scss$/,
            //     loaders: ['style-loader', 'css-loader', 'sass-loader'],
            // },
            {   test: /\.ts$/,
                loader: 'ts-loader'
            }
        ]
    },
    plugins: [
        new CleanWebpackPlugin(['public/components']),
        new LodashModuleReplacementPlugin(),
        // new BundleAnalyzerPlugin,
        // new UglifyJsPlugin,
        new webpack.optimize.CommonsChunkPlugin({
            // name: 'vendor'
            names: ['/js/vue','/js/vendor'],
        })
    ],
    output: {
        publicPath: '/paladin/',
        chunkFilename: './components/[name].js'
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
    .setPublicPath('public')
    .js('resources/assets/js/3rd/blankon/blankon.js','public/js/blankon.js')
    .js('resources/assets/js/3rd/blankon/demo.js','public/js/demo.js')

    // .sass('resources/assets/sass/bootstrap.scss','public/css/bootstrap.css')
    // .sass('resources/assets/sass/element.scss','public/css/element.css')
    // .sass('resources/assets/sass/app.scss','public/css/app.css')

    .js('resources/assets/js/paladin-vue.js','public/js')

    // .styles([
    //         'resources/assets/css/3rd/blankon/pages/sign.css',
    //     ],'public/css/sign.css')

    // .copy('node_modules/bootstrap-vue/dist/bootstrap-vue.min.js','public/js/3rd/bootstrap-vue')
    // .copy('node_modules/bootstrap-vue/dist/bootstrap-vue.css','public/css/3rd/bootstrap-vue')


    .sourceMaps()
;