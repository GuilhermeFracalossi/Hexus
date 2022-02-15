const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

//  mix.webpackConfig({
//     resolve: {
//         fallback: {
//             fs: false,
//             crypto: false,
//             https: false,
//             http: false,
//             os: false,
//             zlib: false
//         }
//     }
// });
mix.options({ legacyNodePolyfills: true })
mix.js('resources/js/app.js', 'public/js').vue().postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
