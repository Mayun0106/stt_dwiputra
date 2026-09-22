import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                soft: '0 24px 80px rgba(124, 58, 237, 0.15)',
                panel: '0 30px 60px rgba(15, 23, 42, 0.08)',
            },
            borderRadius: {
                xl: '1.25rem',
                '2xl': '1.75rem',
            },
        },
    },

    plugins: [forms],
};
