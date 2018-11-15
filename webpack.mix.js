const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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

mix.sass('resources/sass/index.scss', 'public/css')
    .js('resources/js/menu-toggle.js', 'public/js')
    .purgeCss({
        enabled: true
    })
    .copyDirectory('resources/fonts/fontawesome', 'public/fonts');

if (mix.inProduction()) {
    mix.version();
}