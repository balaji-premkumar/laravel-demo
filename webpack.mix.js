const mix = require('laravel-mix');
const webpack = require('webpack');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    plugins: [
        new webpack.ProvidePlugin({
            '$': 'jquery',
            'jQuery': 'jquery',
            'window.jQuery': 'jquery',
        }),
    ]
});


mix.js('resources/js/app.js', 'public/js')
    .extract([
        'jquery',
        'materialize-css'
    ])
    .sass('resources/scss/app.scss', 'public/css')
    .version();
/*
mix.styles([
    'node_modules/materialize-css/dist/css/materialize.min.css',
    'resources/css/app.css'
], 'public/css/app.css');


mix.js([
    'node_modules/materialize-css/dist/js/materialize.min.js',
    'resources/js/app.js'
], 'public/js/app.js');
*/
