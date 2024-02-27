const mix = require('laravel-mix');

// Compile app.js and forms.js
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/forms.js', 'public/js')

// Compile app.scss
mix.sass('resources/sass/app.scss', 'public/css')

// Compile app.css and styles.css
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('autoprefixer'),
]);

// Combine app.css and styles.css into all.css
mix.styles([
    'resources/css/app.css',
    'resources/css/styles.css',
], 'public/css/all.css');

//only load the appropriate css dynamically
mix.copy('node_modules/bootstrap/dist/css/bootstrap.rtl.css', './public/css/bootstrap.rtl.css');
mix.copy('node_modules/bootstrap/scss/bootstrap.scss', './public/css/bootstrap.css');
mix.copy('resources/js/grid-books.js', './public/js/grid-books.js');

