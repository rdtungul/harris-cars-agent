import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                display: ['"Bebas Neue"', 'sans-serif'],
                body:    ['Barlow', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    primary: '#004890',   // Harris blue
                    dark:    '#0F172A',   // slate-900 — deep navy
                    blue:    '#004890',   // Harris blue accent
                    'blue-light': '#dbeafe', // light tint for badges/backgrounds
                },
            },
            letterSpacing: {
                widest: '0.2em',
            },
        },
    },

    plugins: [forms, typography],
};
