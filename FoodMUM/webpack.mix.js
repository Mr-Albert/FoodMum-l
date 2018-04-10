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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
var bower_path = './bower_components';
var js_path = 'public/js';
mix.copy(bower_path + '/pqGrid/pqgrid.min.css', "public/css");   
mix.copy(bower_path + '/pqGrid/pqgrid.min.js', js_path);   
mix.copy(bower_path + '/jqueryui/jquery-ui.js', js_path);   
