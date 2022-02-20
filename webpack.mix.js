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
mix.js('resources/js/app.js', 'public/js').vue({ version: 3 }).postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
]);

mix.webpackConfig({
   resolve: {
        fallback: {
            //demorou 10 horas pra eu descobrir que tinha que fazer isso pra conseguir fazer funcionar os pacotes npm externos
            //so queria deixar anotado mesmo
            
            http: require.resolve("stream-http"),
            https: require.resolve("https-browserify")

        }

   },
});