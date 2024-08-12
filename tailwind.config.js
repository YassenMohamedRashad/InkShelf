import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/* @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./node_modules/flowbite/**/*.js"
        // "./app/Forms/*.php",
        // "./app/Tables/*.php",
    ],

    theme: {
        extend: {
            backgroundImage: {
                'hero-image': "url('/images/home/hero.jpg')",
            },
            colors: {
                'orange-color': '#FF971E',
                'dark-orange': '#D78300'

            },
        },
    },

    plugins: [forms, typography],
};
