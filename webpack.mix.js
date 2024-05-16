const mix = require('laravel-mix');
const VitePlugin = require('laravel-mix-vite');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .vue()
   .version();