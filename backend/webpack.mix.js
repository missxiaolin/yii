let mix = require('laravel-mix');

var fs = require('fs'),
    dirname = __dirname;

var files = JSON.parse(fs.readFileSync(dirname + '/tools/build.json')).modules;
var path = '';

mix.setPublicPath('web/www/');
path = 'web/www/';


files.forEach(function (ele, index) {
    console.log('resources/assets/js/' + ele.src + '.js');
    mix.js('resources/assets/js/' + ele.src + '.js', 'js/' + ele.dest);
});

files.forEach(function (ele, index) {
    mix.sass('resources/assets/sass/' + ele.src + '.scss', 'css/' + ele.dest);
});


if (process.argv.includes('all')) {

    mix.js('resources/assets/js/app.js', 'js')
        .sass('resources/assets/sass/app.scss', 'css').options({
        processCssUrls: false
    });

    mix.copy('resources/assets/lib/', path + 'lib');
    mix.copy('resources/assets/font', path + 'font');
    mix.copy('resources/assets/images', path + 'images');
}

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


