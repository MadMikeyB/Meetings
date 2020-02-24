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
  .babel('resources/js/scripts.js', 'public/js/scripts.js')
  .options({
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
  });
