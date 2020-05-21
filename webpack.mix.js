const mix = require('laravel-mix');

require('laravel-mix-tailwind');

mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .tailwind('./tailwind.config.js')
    .sourceMaps(true, 'hidden-source-map')
    .disableNotifications();

if (mix.inProduction()) {
    mix.version();
}
