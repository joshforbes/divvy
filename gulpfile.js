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
        'resources/assets/js/vendor/jquery.js')
        .copy(
        'vendor/bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
        'resources/assets/js/vendor/bootstrap.js')
        .copy(
        'vendor/bower_components/pusher/dist/pusher.js',
        'resources/assets/js/vendor/pusher.js')
        .copy(
        'vendor/bower_components/font-awesome/css/font-awesome.min.css',
        'public/css/vendor/font-awesome.css')
        .copy(
        'vendor/bower_components/font-awesome/fonts',
        'public/fonts')
        .copy(
        'vendor/bower_components/handlebars/handlebars.min.js',
        'resources/assets/js/vendor/handlebars.js')
        .copy(
        'vendor/bower_components/select2/dist/js/select2.min.js',
        'resources/assets/js/vendor/select2.js')
        .copy(
        'vendor/bower_components/velocity/velocity.min.js',
        'resources/assets/js/vendor/velocity.js')
        .copy(
        'vendor/bower_components/select2/dist/css/select2.min.css',
        'public/css/vendor/select2.css');

    mix.scripts(
        [
            'vendor/jquery.js',
            'vendor/bootstrap.js',
            'vendor/pusher.js',
            'vendor/handlebars.js',
            'vendor/select2.js',
            'vendor/velocity.js',

            'utilities/ajax.js',
            'modules/dashboardModule.js',
            'modules/profileModule.js',
            'modules/projectModule.js',
            'modules/taskModule.js',
            'modules/notificationModule.js',
            'modules/subtaskModule.js',
            'modules/discussionModule.js',
            'modules/commentModule.js',
            'app.js'
        ], 'public/js', 'resources/assets/js'
    );

    mix.styles(
        [
        "vendor/font-awesome.css",
        "app.css"
        ], 'public/css', 'public/css'
    );


    mix.codeception();

});
