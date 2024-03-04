const mix = require('laravel-mix');
const glob = require('glob');

// Function to get all js files and compile them into one
function mixScriptsFromFolder(folderPath, outputFilename) {
    let files = glob.sync(folderPath);
    mix.scripts(files, 'public/js/' + outputFilename);
}

// Example usage for your models and views

// Compile app.js and forms.js
mix.js('resources/js/utils.js', 'public/js');
mix.js('node_modules/underscore/underscore.js', 'public/js/core.js');
mix.js('node_modules/backbone/backbone.js', 'public/js/core.js');
// Initialize the Backbone application
mix.js('resources/js/init.js', 'public/js/core.js');

mix.js('resources/js/app.js', 'public/js');
mix.js('resources/js/forms.js', 'public/js');
mix.js('node_modules/fomantic-ui/dist/semantic.js', 'public/js');



mixScriptsFromFolder('resources/js/models/*.js', 'models.js');
mixScriptsFromFolder('resources/js/views/*.js', 'views.js');

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
mix.copy('node_modules/bootstrap/dist/css/bootstrap.rtl.css', './public/css/bootstrap.rtl.css');

// right-to-left css
mix.copy('node_modules/bootstrap/dist/css/bootstrap.rtl.css', './public/css/bootstrap.rtl.css');

// Copy fonts
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-Regular.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-Regular.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-Bold.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-Bold.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-Italic.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-Italic.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-BoldItalic.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/LatoLatin-BoldItalic.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/Lato-Regular.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/Lato-Regular.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/Lato-Bold.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/Lato-Bold.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/Lato-Italic.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/Lato-Italic.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/Lato-BoldItalic.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/Lato-BoldItalic.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/icons.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/icons.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/brand-icons.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/brand-icons.woff2', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/outline-icons.woff', './public/css/themes/default/assets/fonts');
mix.copy('node_modules/fomantic-ui/dist/themes/default/assets/fonts/outline-icons.woff2', './public/css/themes/default/assets/fonts');
