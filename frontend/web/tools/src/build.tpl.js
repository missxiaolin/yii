/**
 * Build template file.
 * Author: Quentin.Yang
 * Refer: https://github.com/jrburke/r.js/blob/master/build/example.build.js
 * @return object
 */
exports.buildTpl = {
    "appDir": "./www",
    "dir": "./build",
    "mainConfigFile": "./www/js/lib/config.js",
    // "logLevel": 2,//TRACE: 0(Default),INFO: 1,WARN: 2,ERROR: 3,SILENT: 4
    paths: {
        'page.params': "empty:"
    },
   baseUrl: "./js",

    //Another way to use wrap, but uses default wrapping of:
    //(function() { + content + }());
//    wrap: true,

    //Allow "use strict"; be included in the RequireJS files.
    //Default is false because there are not many browsers that can properly
    //process and give errors on code for ES5 strict mode,
    //and there is a lot of legacy code that will not work in strict mode.
    useStrict: true,

    // remove combined files
    removeCombined: true,

    //Finds require() dependencies inside a require() or define call. By default
    //this value is false, because those resources should be considered dynamic/runtime
    //calls. However, for some optimization scenarios, it is desirable to
    //include them in the build.
    //Introduced in 1.0.3. Previous versions incorrectly found the nested calls
    //by default.
    findNestedDependencies: true,

    optimizeCss: 'standard',
    //none  不压缩，仅合并
    //standard  标准压缩 去换行、空格、注释
    //standard.keepLines  除标准压缩外，保留换行
    //standard.keepComments  除标准压缩外，保留注释
    //standard.keepComments.keepLines  除标准压缩外，保留换行和注释

    waitSeconds: 0,

    "modules": [
        //First set up the common build layer.
        // {
            //module names are relative to baseUrl
            // name: "../js/common",
            //List common dependencies here. Only need to list
            //top level dependencies, "include" will find
            //nested dependencies.
            // include: ['jquery', 'jquery.datetimepicker', 'jquery.ui.widget', 'jquery.fileupload', 'jquery.form.validator']
        // },
        // {
        //     name: "../common.mobile",
        //     //List common dependencies here. Only need to list
        //     //top level dependencies, "include" will find
        //     //nested dependencies.
        //     include: ["lib/almond", "fastclick", "zepto", "utils", "zepto.temp", "zepto.sp", "ajax", 'app/lib/detect', 'app/header', 'app/modules/event/track.link', 'app/modules/event/track.event']
        // },
        // {
        //     name: "../common.desktop",
        //     //List common dependencies here. Only need to list
        //     //top level dependencies, "include" will find
        //     //nested dependencies.
        //     include: ["lib/almond", "fastclick", "zepto", "utils", "zepto.temp", "zepto.sp", "ajax", 'app/lib/detect', 'app/modules/event/track.link.desktop', 'app/modules/event/track.event']
        // }

        //Now set up a build layer for each page, but exclude
        //the common one. "exclude" will exclude
        //the nested, built dependencies from "common". Any
        //"exclude" that includes built modules should be
        //listed before the build layer that wants to exclude it.
        //"include" the appropriate "app/main*" module since by default
        //it will not get added to the build since it is loaded by a nested
        //require in the page*.js files.


        //============== Begin: Copy from dependencies.txt ==============


        //============== End: Copy from dependencies.txt ==============


    ]
};