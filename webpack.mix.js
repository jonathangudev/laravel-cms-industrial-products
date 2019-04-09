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
    .js('resources/js/category-menu-toggle.js', 'public/js')
    .js('resources/js/category-menu-accordian.js', 'public/js')
    .js('resources/js/alert-toggle.js', 'public/js')
    .js('resources/js/sort-table.js', 'public/js')
    .sass('resources/sass/index.scss', 'public/css')
    .sass(
        'resources/sass/styles/07-components/_components.buttons.scss',
        'public/css/buttons.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.section.scss',
        'public/css/section.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.breadcrumbs.scss',
        'public/css/breadcrumbs.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.panel.scss',
        'public/css/panel.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.card.scss',
        'public/css/card.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.alert.scss',
        'public/css/alert.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.header.scss',
        'public/css/header.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.footer.scss',
        'public/css/footer.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.subheader.scss',
        'public/css/subheader.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.category-menu.scss',
        'public/css/category-menu.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.product-group.scss',
        'public/css/product-group.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.product-table.scss',
        'public/css/product-table.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.product-jumps.scss',
        'public/css/product-jumps.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.home.scss',
        'public/css/home.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.about.scss',
        'public/css/about.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.contact.scss',
        'public/css/contact.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.products-services.scss',
        'public/css/products-services.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.auth.scss',
        'public/css/auth.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.search-results.scss',
        'public/css/search-results.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.thank-you.scss',
        'public/css/thank-you.css',
    )
    .sass(
        'resources/sass/styles/07-components/_components.admin.scss',
        'public/css/admin.css',
    )
    .purgeCss({
        enabled: true,
        whitelistPatterns: [/--/],
    })
    .copyDirectory('resources/fonts/fontawesome', 'public/fonts');

if (mix.inProduction()) {
    mix.version();
}
