let mix = require('laravel-mix');

let babelOpts = {
  processCssUrls: false,
  autoprefixer: {
    options: {
      grid: true,
      browsers: [
        'last 20 versions', // Set really far back in hopes of generating old prefixes
        'ie 10-11'          // Getting specific
      ]
    }
  }
};

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

mix.babel('resources/js/scripts.js' , 'public/js')
   .options(babelOpts)
   .sass('resources/sass/app.scss', 'public/css',  {sourceMap: true})
   .babel('resources/js/app.js' , 'public/js')
   .options(babelOpts);
