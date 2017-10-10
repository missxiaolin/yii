exports.autoGenerate = (function (dir) {


    var fs = require('fs'),
        path = require('path'),
        dirname = __dirname,
        buildTpl = require(dirname + '/build.tpl.js').buildTpl,//TODO::Find out why.
        outputFile = path.normalize(dirname + '/../build.js');

    var join = require('path').join;


    //得到文件夹下面所有的文件
    function findSync(startPath) {

        startPath = path.resolve(startPath);

        var result = [];

        function finder(path) {
            var files = fs.readdirSync(path);
            files.forEach((val, index) => {
                var fPath = join(path, val);
            var stats = fs.statSync(fPath);
            if (stats.isDirectory()) {
                finder(fPath);
            }
            if (stats.isFile()) {
                result.push(fPath.replace(startPath + '/', ''));
            }
        });
        }

        finder(startPath);
        return result;
    }

    /**
     * Get dependencies according to the code like this: "require['app/test']"
     * @param file
     * @returns {string.} e.g. "['app/test']"
     */
    function getDependence(file) {
        // read sync.
        var content = fs.readFileSync(file, 'utf-8');
        var dependence = parseFile(content);
        return dependence;
    }

    /**
     * Parse file content, and get required content.
     * @param content
     * @returns string. e.g: "['app/test', 'app/biz']"
     */
    function parseFile(content) {
        var results = content.match(/\[(.*?)\]/g);
        return results ? results[0] : '[]';
    }

    /**
     * Get
     * @param dir
     * @returns {Array}
     */
    function getDirDependence(dir) {

        //  var files = fs.readdirSync(dir),
        var files = findSync(dir),
            dependencies = [],
            excludes = ['common.js', 'unit.js', 'tap.js', 'test.tap.js', 'test.fastclick.js'],
            file, filename;


        for (var i = 0, len = files.length; i < len; i++) {
            file = files[i];
            if (-1 === excludes.indexOf(file) && /\.js/.test(file)) {
                filename = file.substr(0, file.length - 3);

                dependencies.push(_jsonTemplate(filename, getDependence(dir + '/' + file)));
            }
        }
        return dependencies;
    }

    /**
     * Hard-code the json template.
     *
     * {
     *   //module names are relative to baseUrl/paths config
     *   name: '../example-home',
     *   exclude: ['../common']
     * }
     * @param file string
     * @param dependencies string. e.g: "['app/test', 'app/biz']"
     * @returns {{name: string, include: Object, exclude: string[]}}
     * @private
     */
    function _jsonTemplate(file, dependencies) {
        var temp = {
            name: '../pages/' + file,
            include: eval(dependencies),
            exclude: ['../js/lib/config']
        }
        return temp;
    }

    function updateScript(options) {
        var dependenciesArray = getDirDependence(options.dir),
            output = options.output ? options.output : outputFile,
            buildContent;

        buildTpl.modules = buildTpl.modules.concat(dependenciesArray);
        buildContent = JSON.stringify(buildTpl, null, 4);

        fs.writeFile(output, buildContent, function (err) {
            if (err) {
                throw err;
            }
            console.log('It\'s done.');
        });
    }

    return {
        getDirDependencies: getDirDependence,
        updateScript: updateScript
    }


})();