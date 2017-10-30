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
/******/ 	return __webpack_require__(__webpack_require__.s = 61);
/******/ })
/************************************************************************/
/******/ ({

/***/ 1:
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

/***/ 23:
/***/ (function(module, exports, __webpack_require__) {

$(function () {
    var modal = __webpack_require__(1);

    $('.btn').click(function () {
        modal({
            title: 'hellow', //标题
            content: 'content', //内容
            footer: '<button type="button" class="btn btn-default confirm" data-dismiss="modal">关闭</button>', //底部
            width: 600, //宽度
            events: {
                confirm: function confirm() {
                    //哪个元素上有.confirm类，被点击就执行这个回调
                    alert('点击了关闭按钮');
                }
            }
        });
    });
});

/***/ }),

/***/ 61:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(23);


/***/ })

/******/ });