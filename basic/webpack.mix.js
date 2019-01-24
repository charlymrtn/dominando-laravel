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

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css'
],'public/css/app.css')
    .scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'resources/js/custom.js'
    ],'public/js/app.js');
    //.sass('resources/sass/app.scss', 'public/css');
    //.js('resources/js/app.js', 'public/js')
   // .sass('resources/sass/blog.scss','public/css')
   // .styles([
   //     'resources/css/a.css',
   //     'resources/css/b.css'
   // ],'public/css/styles.css');

mix.browserSync({
   proxy: '127.0.0.1:8000'
});
