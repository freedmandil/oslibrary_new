const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);

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
