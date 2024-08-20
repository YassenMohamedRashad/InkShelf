import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            backgroundImage: {
                'hero-image': "/images/home/hero.jpg",
            },
            fontFamily: {
                sans: [ 'Figtree', ...defaultTheme.fontFamily.sans ],
                'Rubik': 'Rubik',
                'Cairo': 'Cairo'
            },
            colors: {
                'orange-color': '#FF971E',
                'dark-orange': '#D78300',
                'light-orange': '#FFAB32',

            },



        },
    },

    plugins: [
        forms,
        daisyui
    ],
};
