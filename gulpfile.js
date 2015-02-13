var elixir = require('laravel-elixir');

require('laravel-elixir-codeception');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */


elixir(function(mix) {
 mix.sass('app.scss')
     .copy(
     'vendor/bower_components/jquery/dist/jquery.min.js',
     'public/js/vendor/jquery.js'
     )
     .copy(
     'vendor/bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
     'public/js/vendor/bootstrap.js'
     )
     //.copy(
     //'vendor/bower_components/font-awesome/css/font-awesome.min.css',
     //'public/css/vendor/font-awesome.css'
     //)
     //.copy(
     //'vendor/bower_components/font-awesome/fonts',
     //'public/css/fonts'
     //)
     .copy(
     'vendor/bower_components/handlebars/handlebars.min.js',
     'public/js/vendor/handlebars.js'
     )
     //.copy(
     //'vendor/bower_components/pusher/dist/pusher.min.js',
     //'public/js/vendor/pusher.js'
     //);

    mix.codeception();

    //mix.scripts([
    //    "app.js"
    //]);
});
