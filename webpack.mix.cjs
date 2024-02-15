const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .sass('resources/sass/app.scss', 'public/css')
    .less('resources/less/app.less', 'public/css')
    .version() // Enable versioning.
    .sourceMaps(); // Create source maps.
