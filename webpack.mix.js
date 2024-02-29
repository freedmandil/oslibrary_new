const mix = require('laravel-mix');

// Compile app.js and forms.js
mix.js('resources/js/app.js', 'public/js');
mix.js('resources/js/utils.js', 'public/js');
mix.js('resources/js/forms.js', 'public/js');
mix.js('node_modules/fomantic-ui/dist/semantic.js', 'public/js');

// Compile app.scss
mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('node_modules/bootstrap/scss/bootstrap-grid.scss', 'public/css');
mix.sass('node_modules/bootstrap/scss/bootstrap-utilities.scss', 'public/css');
mix.sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css');


// Compile app.css and styles.css
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('autoprefixer'),
]);

// Combine app.css and styles.css into all.css
mix.styles([
    // Import ag-Grid styles
    'node_modules/ag-grid-community/styles/ag-grid.css',
    'node_modules/ag-grid-community/styles/ag-theme-alpine.css',

    // import fomantic-ui
    'node_modules/fomantic-ui/dist/semantic.css',

    //regular styling
    'resources/css/app.css',
    'resources/css/styles.css',
], 'public/css/all.css');

//only load the appropriate css/js
mix.copy('node_modules/bootstrap/dist/css/bootstrap.rtl.css', './public/css/bootstrap.rtl.css');
mix.copy('resources/js/grid-books.js', './public/js/grid-books.js');
mix.copy('node_modules/bootstrap/dist/css/bootstrap.rtl.css', './public/css/bootstrap.rtl.css');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-Regular.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-Regular.woff2', './public/css/themes/default/assets/fonts');

