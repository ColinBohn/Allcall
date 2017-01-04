const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    var bootstrapPath = 'node_modules/bootstrap-sass/assets';
    var jqueryPath = 'node_modules/jquery/dist';
    
    mix.sass('app.scss')
        .copy(bootstrapPath + '/fonts', 'public/fonts')
        .copy(bootstrapPath + '/javascripts/bootstrap.js', 'resources/assets/js')
        .copy(jqueryPath + '/jquery.js', 'resources/assets/js')
        .scripts(['jquery.js', 'bootstrap.js', 'bootstrap-toggle.js'])
        .scripts('broadcast.js')
        .styles(['bootstrap-toggle.css', 'custom.css']);
});
