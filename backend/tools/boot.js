(function () {
    var dirname = __dirname;

    var autoGenerate = require(dirname + '/autoGenerate.js').autoGenerate;

    // auto generating build source file.

    autoGenerate.updateScript({
        dir: dirname + '/../web/original/js',
        output: dirname + '/build.json'
    });

})();