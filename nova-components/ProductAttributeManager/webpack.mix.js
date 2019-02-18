let mix = require('laravel-mix');

mix.disableSuccessNotifications()
    .js('resources/js/tool.js', 'dist/js')
    .sass('resources/sass/tool.scss', 'dist/css');
