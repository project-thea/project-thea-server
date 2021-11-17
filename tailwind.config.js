const defaultTheme = require('tailwindcss/defaultTheme');
const path = require('path');
const colors = require('tailwindcss/colors');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
		path.resolve(__dirname, './node_modules/litepie-datepicker/**/*.js')
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
			colors: {
			// Change with you want it
			'litepie-primary': colors.purple, // color system for light mode
			'litepie-secondary': colors.coolGray // color system for dark mode
			}
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
