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

mix.js('resources/js/menu-toggle.js', 'public/js')
    .sass('resources/sass/index.scss', 'public/css')
    // .sass('resources/sass/styles/07-components/_components.buttons.scss', 'public/css/buttons.css')
    // .sass('resources/sass/styles/07-components/_components.section.scss', 'public/css/section.css')
    // .sass('resources/sass/styles/07-components/_components.breadcrumbs.scss', 'public/css/breadcrumbs.css')
    // .sass('resources/sass/styles/07-components/_components.panel.scss', 'public/css/panel.css')
    // .sass('resources/sass/styles/07-components/_components.card.scss', 'public/css/card.css')
    // .sass('resources/sass/styles/07-components/_components.header.scss', 'public/css/header.css')
    // .sass('resources/sass/styles/07-components/_components.footer.scss', 'public/css/cafooterss')
    // .sass('resources/sass/styles/07-components/_components.subheader.scss', 'public/css/cardsubheader')
    // .sass('resources/sass/styles/07-components/_components.category-menu.scss', 'public/css/category-menu.css')
    // .sass('resources/sass/styles/07-components/_components.home.scss', 'public/css/chomecss')
    // .sass('resources/sass/styles/07-components/_components.about.scss', 'public/css/caboutcss')
    // .sass('resources/sass/styles/07-components/_components.contact.scss', 'public/css/cacontactss')
    // .sass('resources/sass/styles/07-components/_components.products-services.scss', 'public/css/carproducts-servicess')
    .purgeCss({
        enabled: true
    })
    .copyDirectory('resources/fonts/fontawesome', 'public/fonts');

if (mix.inProduction()) {
    mix.version();
}