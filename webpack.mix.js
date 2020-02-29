let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/sass/app.scss', 'public/css/style.css',  {sourceMap: true})
   .sourceMaps(true, 'source-map')
   .babel(['resources/js/functions.js', 'resources/js/scripts.js'], 'public/js/scripts.js')
   .babel('resources/js/app.js', 'public/js/app.js');
