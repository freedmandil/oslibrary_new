const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/tailwind.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]).styles([
    'public/css/tailwind.css', // Output from the postCss process
    'resources/css/app.css',
    'resources/css/styles.css',
], 'public/css/all.css');

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.js$/, // A regexp that catches .js files
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'] // Use the preset
                    }
                }
            }
        ]
    }
});
