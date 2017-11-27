/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 68);
/******/ })
/************************************************************************/
/******/ ({

/***/ 29:
/***/ (function(module, exports, __webpack_require__) {

$(function () {
    var message = __webpack_require__(61);

    var confirm = __webpack_require__(60);

    $('.btn').click(function () {
        // message('基本使用','','warning')
        confirm('确定删除吗?', function () {
            alert('点击确定后执行的回调函数');
        });
    });
    // 基本使用
    // message('弹出框宽度100%', '', 'success', 2, {width: '80%'});

    // message('使用modal模态框事件处理', '', 'success', 2, {
    //     events: {
    //         'hidden.bs.modal': function () {
    //             alert('模态框消失时');
    //         }
    //     }
    // });

});

/***/ }),

/***/ 4:
/***/ (function(module, exports) {

module.exports = function (options) {
    var opt = Object.assign({
        show: true, //自动显示
        title: '', //标题
        content: '', //内容
        footer: '', //底部
        id: 'hdMessage', //模态框id
        width: 600, //宽度
        class: '', //样式
        option: {}, //bootstrap模态框选项
        events: {} //事件,参考bootstrap
    }, options);

    var modalObj = $("#" + opt.id);

    if (modalObj.length == 0) {
        $(document.body).append('<div class="modal fade" id="' + opt.id + '"role="dialog" tabindex="-1" role="dialog" aria-hidden="true"></div>');
        modalObj = $("#" + opt.id);
    }
    var html = '<div class="modal-dialog" role="document">' + '<div class="modal-content ' + opt.class + '">';
    if (opt.title) {
        html += '<div class="modal-header">' + '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' + '<span aria-hidden="true">&times;</span></button>' + '<h4 class="modal-title">' + opt.title + '</h4></div>';
    }

    //模态框内容
    if (opt.content) {
        if (!$.isArray(opt.content)) {
            html += '<div class="modal-body">' + opt.content + '</div>';
        } else {
            html += '<div class="modal-body">正在加载中...</div>';
        }
    }
    if (opt.footer) {
        html += '<div class="modal-footer">' + opt.footer + '</div>';
    }
    html += "</div></div>";
    modalObj.html(html);
    if (opt.width) {
        modalObj.find('.modal-dialog').css({ width: opt.width });
    }
    if (opt.content && $.isArray(opt.content)) {
        //将异步加载内容放入模态体中
        var callback = function callback(d) {
            modalObj.find('.modal-body').html(d);
        };
        if (opt.content.length == 2) {
            $.post(opt.content[0], opt.content[1]).done(callback);
        } else {
            $.get(opt.content[0]).done(callback);
        }
    }
    //绑定模态事件
    $(opt.events).each(function (i) {
        for (name in opt.events) {
            if (typeof opt.events[name] == 'function') {
                modalObj.on(name, opt.events[name]);
            }
        }
    });
    //点击确定按钮事件
    if (typeof opt.events['confirm'] == 'function') {
        modalObj.find('.confirm', modalObj).on('click', function () {
            options.events['confirm'](modalObj);
            //隐藏模态框
            modalObj.modal('hide');
        });
    }
    //关闭模态框时删除他
    modalObj.on('hidden.bs.modal', function () {
        modalObj.remove();
    });
    /**
     * 有确定按钮时添加事件
     * 当点击确定时删除模态框
     */
    modalObj.on('hidden.bs.modal', function () {
        modalObj.remove();
    });
    //点击取消按钮事件
    if (typeof opt.events['cancel'] == 'function') {
        modalObj.find('.cancel', modalObj).on('click', function () {
            options.events['cancel'](modalObj);
        });
    }

    return modalObj.modal(opt);
};

/***/ }),

/***/ 60:
/***/ (function(module, exports, __webpack_require__) {

module.exports = function (content, callback, options) {
    var Modal = __webpack_require__(4);

    var content = '			<i class="pull-left fa fa-4x fa-info-circle"></i>' + '			<div class="pull-left"><p>' + content + '</p>' + '			</div>' + '			<div class="clearfix"></div>';
    var modalobj = Modal($.extend({
        title: '系统提示',
        content: content,
        footer: '<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>' + '<button type="button" class="btn btn-primary confirm">确定</button>',
        events: {
            confirm: function confirm() {
                if ($.isFunction(callback)) {
                    modalobj.modal('hide');
                    callback();
                }
            }
        }
    }, options));
    modalobj.find('.modal-content').addClass('alert alert-info');
    return modalobj;
};

/***/ }),

/***/ 61:
/***/ (function(module, exports, __webpack_require__) {

module.exports = function (msg, redirect, type, timeout, options) {
    var Modal = __webpack_require__(4);

    if ($.isArray(msg)) {
        msg = msg.join('<br/>');
    }
    timeout = timeout ? timeout : 2;
    if (!redirect && !type) {
        type = 'info';
    }
    if ($.inArray(type, ['success', 'error', 'info', 'warning']) == -1) {
        type = '';
    }
    if (type == '') {
        type = redirect == '' ? 'error' : 'success';
    }
    var icons = {
        success: '&#xe629;',
        error: '&#xe601;',
        info: '&#xe608;',
        warning: '&#xe624;'
    };

    var h = '';
    if (redirect && redirect.length > 0) {
        if (redirect == 'back') {
            h = '<p>' + '<a href="javascript:;" onclick="history.go(-1)">' + '如果你的浏览器在 <span id="timeout">' + timeout + '</span> 秒后没有自动跳转，请点击此链接</a></p>';
            redirect = document.referrer ? document.referrer : location.href;
        } else if (redirect == 'refresh') {
            redirect = location.href;
            h = '<p><a href="' + redirect + '" target="main" data-dismiss="modal" aria-hidden="true">系统将在 <span id="timeout"></span> 秒后刷新页面</a></p>';
        } else {
            h = '<p><a href="' + redirect + '" target="main" data-dismiss="modal" aria-hidden="true">如果你的浏览器在 <span id="timeout">' + timeout + '</span> 秒后没有自动跳转，请点击此链接</a></p>';
        }
    }
    var content = '			<i class="iconfont pull-left">' + icons[type] + '</i>' + '			<div class="pull-left"><p>' + msg + '</p>' + h + '			</div>' + '			<div class="clearfix"></div>';
    var footer = '			<button type="button" class="btn btn-default" data-dismiss="modal">确认</button>';

    var modalobj = Modal($.extend({
        title: '系统提示',
        content: content,
        footer: footer,
        id: 'modalMessage'
    }, options));
    modalobj.find('.modal-content').addClass('alert alert-' + type);

    if (redirect) {
        var doredirect = function doredirect() {
            timer = setTimeout(function () {
                if (timeout <= 0) {
                    modalobj.modal('hide');
                    clearTimeout(timer);
                    window.location.href = redirect;
                    return;
                } else {
                    timeout--;
                    modalobj.find("#timeout").html(timeout);
                    doredirect();
                }
            }, timeout * 1000);
        };

        var timer = '';
        modalobj.find("#timeout").html(timeout);
        modalobj.on('show.bs.modal', function () {
            doredirect();
        });
        modalobj.on('hide.bs.modal', function () {
            timeout = 0;
            doredirect();
        });
        modalobj.on('hidden.bs.modal', function () {
            modalobj.remove();
        });
    }
    modalobj.modal('show');
    return modalobj;
};

/***/ }),

/***/ 68:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(29);


/***/ })

/******/ });