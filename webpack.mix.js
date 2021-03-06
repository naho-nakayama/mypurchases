const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/front.scss', 'public/css') // 追記右のpublicのところは、cssを画面に反映させるところ
    .sass('resources/sass/bought.scss', 'public/css')
    .sass('resources/sass/bought_carender.scss', 'public/css')
    .sass('resources/sass/want.scss', 'public/css')
    .sass('resources/sass/register.scss', 'public/css');
