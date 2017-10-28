let mix = require('laravel-mix');

var fs = require('fs'),
    dirname = __dirname;

var files = JSON.parse(fs.readFileSync(dirname + '/tools/build.json')).modules;
var path = '';

mix.setPublicPath('web/www/');
path = 'web/www/';


files.forEach(function (ele, index) {
    console.log('web/original/js/' + ele.src + '.js');
    mix.js('web/original/js/' + ele.src + '.js', 'js/' + ele.dest);
});

files.forEach(function (ele, index) {
    mix.sass('web/original/sass/' + ele.src + '.scss', 'css/' + ele.dest);
});


if (process.argv.includes('all')) {

    mix.js('web/original/js/app.js', 'js')
        .sass('web/original/sass/app.scss', 'css').options({
        processCssUrls: false
    });

    mix.copy('web/original/lib/', path + 'lib');
    mix.copy('web/original/font', path + 'font');
    mix.copy('web/original/images', path + 'images');
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


