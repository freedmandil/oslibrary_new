// CommonJS Syntax for TailwindCSS Configuration

/**
 * @type {import('tailwindcss').Config}
 */
module.exports = {
    content: [
        '../js/**/*.js',
        './**/*.{js,html}'
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('daisyui'),
    ],
};

