
/**
 * As our first step, we'll pull in the user's webpack.mix.js
 * file. Based on what the user requests in that file,
 * a generic config object will be constructed for us.
 */

let mix = require('laravel-mix');

require(Mix.paths.mix());

/**
 * Just in case the user needs to hook into this point
 * in the build process, we'll make an announcement.
 */

Mix.dispatch('init', Mix);

/**
 * Now that we know which build tasks are required by the
 * user, we can dynamically create a configuration object
 * for Webpack. And that's all there is to it. Simple!
 */

let WebpackConfig = require('laravel-mix/setup/webpack.config');

// WebpackConfig.output.publicPath = '/paladin';

// let fs = require('fs');
// fs.writeFileSync('webpack.show.config.json',JSON.stringify(WebpackConfig,null,6));

module.exports = WebpackConfig;

