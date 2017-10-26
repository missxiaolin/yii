/**
 *
 * Please include two libraries before using it:
 *  - js/lib/uploadify/jquery.uploadify.js (IE flash)
 *  - js/lib/jquery-file-upload/js/jquery.fileupload.js (Chrome, FF, Safari)
 *
 * Steps as following:
 *  Step 1: put the following code in your view to include those library:
 *      \Angejia\Helpers\Resource::add_external_js(array(
 *        '../lib/uploadify/jquery.uploadify',
 *        '../lib/jquery-file-upload/js/vendor/jquery.ui.widget',
 *        '../lib/jquery-file-upload/js/jquery.fileupload'
 *      ));
 *
 *  Step 2: require this module in your JS file, and execute fileupload function:
 *      // require module.
 *      var fileupload = require('./modules/fileupload');
 *      // execute fileupload funciton.
 *      fileupload({
 *        dom: $(".fileupload"),
 *        callback: function (result) {
 *            // result:
 *            // {
 *            //     id: "98693",
 *            //     url: "http://7tebqs.com2.z0.glb.qiniucdn.com/FlSY_xdQSZkdmRzn9-wiYZIaYYVm"
 *            // }
 *          }
 *      });
 *
 * @returns {uploader}
 */

module.exports = (function fileupload($) {
    "use strict";

    // get token
    var isIE = (function (ver) {
            var b = document.createElement('b')
            b.innerHTML = '<!--[if IE ' + ver + ']><i></i><![endif]-->'
            return b.getElementsByTagName('i').length === 1
        })(),
        returnUrl = location.protocol + '//' + location.hostname + '/api/upload',// jshint ignore:line
        uploadUrl = "http://upload.qiniu.com/",
        forceIframeTransport = isIE;// jshint ignore:line
    var fileType = '';
    // get token
    function getToken() {
        // var url = 'http://mobi.develop.dev.angejia.com/storage-tokens',
        var token,
            url = '/api/qi-niu/storage-tokens',
            data = null;// (isIE) ? {return_url: returnUrl} : null;
        $.http({
            url: url,
            type: 'GET',
            async: false,
            data: data,
            success: function (response) {
                token = response.items[0];
            },
            error: function () {
                alert('环境变量配置有误，请联系管理员。');// jshint ignore:line
            }
        });

        return token;
    }

    /**
     * upload file.
     * @param options
     * {
     *  dom: $('#input-file')
     *  callback: function() {}
     * }
     *
     */
    function uploader(options) {
        (isIE) ? _uploadByFlash(options) : _uploadByXhr(options);// jshint ignore:line
    }

    function _uploadByXhr(options) {
        var $dom = options.dom,
            configs = _uploadConfigXhr(options);

        configs.url = uploadUrl;

        $dom.fileupload(configs);
    }

    function _uploadConfigXhr(options) {
        var Errors = {},
            fnStart = options.start,
            fnAlways = options.always,
            fnProgress = options.progress,
            resOptions;

        function doneFN(e, result) {
            options.callback(result.result, fileType, result.files);
        }

        function addCallback(e, data) {
            fileType = data.originalFiles[0]['type'];
            if (options.acceptFileTypes) {
                if (_validateAcceptFileTypes(options.acceptFileTypes, data) === false) {
                    (typeof fnAlways === 'function') && fnAlways(e, data, Errors);// jshint ignore:line
                    alert(Errors.accepetFileType.join('\n'));// jshint ignore:line
                    return;
                }
            }

            (typeof fnStart === 'function') && fnStart(e, data);// jshint ignore:line

            data.formData = data.formData || {'x:fops': 'imageView2/1/w/250/h/250'};
            data.formData.token = getToken();
            data.submit();

        }

        /**
         * Validate accept file type.
         * @param types ['jpe?g', 'gif', 'png']
         *
         * @private
         */
        function _validateAcceptFileTypes(types, data) {
            // /^image\/(gif|jpe?g|png)$/i;
            //change by wangxinzhuo to upload pdf
            //var regRule = '^image\/(' + types.join('|') + ')$';
            var regRule = '';
            var errorTip = '';
            if (types[0] == 'plain') {
                regRule = '^image|application\/(' + types.join('|') + ')$';
                errorTip = "请上传JPG、PNG、BMP格式的图片";
            } else if (types[0] == 'video') {
                regRule = '^video|application\/(' + types.join('|') + ')$';
                errorTip = "请上传常见的音频文件";
            } else if (types[0] == 'file') {
                regRule = '^(.*)\/(' + types.join('|') + ')$';
                errorTip = "请上传正确文件";
            } else if (types[0] == 'pdf') {
                regRule = '^(application)\/(' + types.join('|') + ')$';
                errorTip = "请上传pdf格式的文件";
            } else {
                regRule = '^text|application\/(' + types.join('|') + ')$';
                errorTip = "请上传文件";
            }
            var uploadErrors = [];
            var acceptFileTypes = new RegExp(regRule, 'i');
            if (data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {// jshint ignore:line
                uploadErrors.push(errorTip);
            }
//        if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) {
//            uploadErrors.push('Filesize is too big');
//        }
            Errors.accepetFileType = uploadErrors;

            return (uploadErrors.length === 0);
        }

        resOptions = {
            formData: {
                token: ''
            },
            add: addCallback,
            done: doneFN
        };

        if (typeof fnAlways === 'function') {
            resOptions.always = fnAlways;
        }

        if (typeof fnProgress === 'function') {
            resOptions.progress = fnProgress;
        }

        return resOptions;
    }


    function _uploadByFlash(options) {
        // jshint undef: false, unused: false, camelcase: false, expr: true, eqeqeq: false
        var $dom = options.dom,
            callback = options.callback,
            fileTypes = options.acceptFileTypes,
            fnStart = options.start,
            fnAlways = options.always,
            fileTypeRules = [];

        var uploadParams = {
            buttonText: '上传图片',
            fileObjName: 'file',
            formData: {token: ''},
            'swf': '/dist/lib/uploadify/uploadify.swf',
            'uploader': uploadUrl,
            onSelect: function (file) {
                (typeof fnStart === 'function') && fnStart({}, file);// jshint ignore:line

                var formData = this.settings.formData;
                formData.token = getToken();
                $dom.uploadify("settings", "formData", formData);
            },
            onUploadSuccess: function (file, data, response) {
                var results = JSON.parse(data);//{id: '', url: ''}
                callback(results);
                (typeof fnAlways === 'function') && fnAlways(file, results);// jshint ignore:line
            },
            onUploadError: function (file, errorCode, errorMsg, errorString) {
                //-200 "400" "HTTP Error (400)"
                callback({
                    error: errorString
                });
                (typeof fnAlways === 'function') && fnAlways(null, null, [errorString]);// jshint ignore:line
            }
        };

        if (fileTypes) {
            for (var i = 0; i < fileTypes.length; i++) {
                fileTypeRules.push('*.' + fileTypes[i]);
            }
            uploadParams.fileTypeExts = fileTypeRules.join(';');
            uploadParams.fileTypeDesc = 'Image Files';
        }

        $dom.uploadify(uploadParams);

    }

    return uploader;
})(jQuery); //jshint ignore: line

