/** @type {import('tailwindcss').Config} */
export default {
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
   }
