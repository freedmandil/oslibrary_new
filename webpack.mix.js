const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/forms.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('autoprefixer'),
    ]).styles([
    'resources/css/app.css',
    'resources/css/styles.css',
], 'public/css/all.css');

// mix.webpackConfig({
//     module: {
//         rules: [
//             {
//                 test: /\.js$/, // A regexp that catches .js files
//                 exclude: /node_modules/,
//                 use: {
//                     loader: 'babel-loader',
//                     options: {
//                         presets: ['@babel/preset-env'] // Use the preset
//                     }
//                 }
//             }
//         ]
//     }
// });
