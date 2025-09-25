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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': {
                    50: '#f0f4ff',
                    100: '#e0e9ff',
                    200: '#c7d8ff',
                    300: '#a5bfff',
                    400: '#819bff',
                    500: '#0E2A66', // Primary blue
                    600: '#153476', // Secondary blue
                    700: '#283593', // Dark blue
                    800: '#1e2a5e',
                    900: '#1a1f3a',
                },
                'sidebar': {
                    'start': '#0E2A66', // 0%
                    'middle': '#153476', // 65%
                    'end': '#283593',   // 100%
                }
            },
            backgroundImage: {
                'gradient-sidebar': 'linear-gradient(135deg, #0E2A66 0%, #153476 65%, #283593 100%)',
                'gradient-primary': 'linear-gradient(135deg, #0E2A66 0%, #153476 65%, #283593 100%)',
            }
        },
    },

    plugins: [forms],
};
