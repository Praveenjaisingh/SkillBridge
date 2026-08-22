import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#f2f4ff',
                    100: '#e6e9fe',
                    200: '#c6cbfc',
                    300: '#a3a8f8',
                    400: '#8579f3',
                    500: '#7057ee',
                    600: '#6238e0',
                    700: '#522bc2',
                    800: '#44259c',
                    900: '#38217c',
                    950: '#211351',
                },
                accent: {
                    50: '#eefcf6',
                    100: '#d5f8e8',
                    200: '#adf0d4',
                    300: '#75e2ba',
                    400: '#3ecb9d',
                    500: '#1cb083',
                    600: '#128e6b',
                    700: '#127258',
                    800: '#135b47',
                    900: '#124b3c',
                },
            },
            boxShadow: {
                soft: '0 2px 10px -3px rgba(56, 33, 124, 0.12), 0 1px 2px -1px rgba(56, 33, 124, 0.08)',
                card: '0 4px 20px -4px rgba(56, 33, 124, 0.15)',
                glow: '0 0 0 1px rgba(112, 87, 238, 0.08), 0 8px 24px -8px rgba(112, 87, 238, 0.35)',
            },
            backgroundImage: {
                'brand-gradient': 'linear-gradient(135deg, #7057ee 0%, #a855f7 50%, #6238e0 100%)',
                'brand-radial': 'radial-gradient(circle at top, #e6e9fe 0%, #f2f4ff 45%, #ffffff 100%)',
            },
            borderRadius: {
                xl2: '1.25rem',
            },
        },
    },

    plugins: [forms],
};
