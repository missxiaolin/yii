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
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ (function(module, exports) {

module.exports = function ($) {
    /*
     备注：组件内所有使用的单位都是px，所以外部传入可能需要做单位转化（如rem转px）
     */
    function Popup(options) {
        $.inherit(this, $.Observer);

        var defOpts = {
            isMask: true, //是否需要遮罩层
            maskColor: '#333', //默认遮罩层颜色
            maskOpacity: '0.5', //默认遮罩层透明度
            content: '', //需要插入的html代码
            contentBg: '#FFF', //content的默认背景色
            width: null, //默认宽度
            height: null,
            position: {}, //指定pop的位置({top, left, right, bottom}, 不需要单位。如：position:{left: 0, bottom: 0})
            maskName: 'pop-mask', //mask类名,供外部样式设置
            contentName: 'pop-content',
            containerName: 'pop-container',
            confirmBtn: '.pop-confirm',
            cancelBtn: '.pop-cancel',
            extraBtn: '.pop-extra',
            showTime: 0 //showTime时间以后自动消失，如果为0则不消失
        };
        this.opts = $.extend(defOpts, options);
        this.$container = null;
        this.$mask = null;
        this.$panel = null;
        this._data = null;
        this.init();
        this.initEvent();
    }

    Popup.prototype.init = function () {
        var self = this;
        self.$container = createContainer(self.opts.containerName);
        self.opts.isMask ? (self.$mask = createMask(self.opts), self.$mask.appendTo(self.$container)) : null; // jshint ignore:line
        self.$panel = createPanel(self.opts);
        self.$panel.appendTo(self.$container);
        self.$container.appendTo($(document.body));
        //对于未主动设置宽高的，手动设置
        self.opts.width ? null : self.opts.width = self.$panel.width(); // jshint ignore:line
        self.opts.height ? null : self.opts.height = self.$panel.height(); // jshint ignore:line

        calcContentPos(self.opts, self.$panel);
        bindEvent(self.opts, self.$panel);
        self.closePop();
    };

    Popup.prototype.initEvent = function () {
        var self = this;
        $(self.opts.confirmBtn).on('click', function () {
            self.trigger('popup_confirm', [self._data]);
        });

        $(self.opts.cancelBtn).on('click', function () {
            self.trigger('popup_cancel', arguments);
        });

        $(self.opts.extraBtn).on('click', function (e) {
            self.trigger('popup_extra', [self._data, e]);
        });
    };

    //hide all
    Popup.prototype.closePop = function () {
        var self = this;
        self.$container.hide();
        recoverScroll();
        self.trigger('popup_close', arguments);
    };

    /**
     show all
     @param isresetPos 表示是否需要重新计算位置(默认不重新计算)
     */
    Popup.prototype.showPop = function (opt) {
        var self = this;
        self._data = opt.data;
        self.trigger('popup_show', arguments);
        self.$container.show();
        if (self.opts.showTime > 0 || opt && opt.showTime > 0) {
            setTimeout(function () {
                // jshint ignore:line
                self.closePop();
            }, self.opts.showTime || opt.showTime);
        }
        preventScroll();
    };

    /**
     更改展示内容
     @param options包含以下内容
     tpl 需要替换的内容的html字符串（必选）
     height 替换后内容的高度（默认，自动获取）（可选）
     width 替换后内容的宽度（默认，自动获取）（可选）
     isResetPos 是否需要重新计算位置（默认是会重新计算的，false：不重新计算；true：重新计算）（可选）
     */
    Popup.prototype.changeContent = function (options) {
        var self = this;
        self.$panel.html(options.tpl);
        //更改高宽
        options.height ? (self.opts.height = options.height, options.isResetPos = true) : self.opts.height = self.$panel.height(); //jshint ignore:line
        options.width ? (self.opts.width = options.width, options.isResetPos = true) : self.opts.width = self.$panel.width(); //jshint ignore:line

        options.isResetPos ? calcContentPos(self.opts, self.$panel) : null; //jshint ignore:line
    };

    //重新计算content的位置
    function calcContentPos(opts, $panel) {
        var pos = {},
            p = opts.position;
        p.left || p.left === 0 ? pos.left = p.left + 'px' : p.right || p.right === 0 ? pos.right = p.right + 'px' : (pos.left = '50%', pos.marginLeft = '-' + opts.width / 2 + 'px'); // jshint ignore:line
        p.top || p.top === 0 ? pos.top = p.top + 'px' : p.bottom || p.bottom === 0 ? pos.bottom = p.bottom + 'px' : (pos.top = '50%', pos.marginTop = '-' + opts.height / 2 + 'px'); // jshint ignore:line
        $panel.css(pos);
    }

    //绑定事件
    function bindEvent(opts, $panel) {
        $(window).on('resize', function () {
            calcContentPos(opts, $panel);
        });
    }

    //阻止mask后面内容滚动
    function preventScroll() {}
    //$('body').css('overflow', 'hidden');


    //恢复mask后面内容的正常滚动
    function recoverScroll() {}
    // $('body').css('overflow', 'auto')


    //创建最外层的container
    function createContainer(containerName) {
        var tpl = '<div style="width: 100%; height: 100%;position: fixed;z-index: 50;" class="' + containerName + '"></div>';
        return $(tpl);
    }

    //创建遮罩层
    function createMask(opts) {
        var style = 'z-index: 15; width: 100%; height: 100%; position: fixed; left: 0; top: 0;background-color:' + opts.maskColor + '; opacity: ' + opts.maskOpacity + ';' + 'filter: progid:DXImageTransform.Microsoft.Alpha(opacity=50);';
        var tpl = '<div style="' + style + '" class="' + opts.maskName + '"></div>';
        return $(tpl);
    }

    //创建panel主体内容
    function createPanel(opts) {
        var styleW = '',
            styleH = '';
        !isNaN(opts.width * 1) ? styleW = 'width: ' + opts.width + 'px;' : opts.width == '100%' ? opts.width : null; // jshint ignore:line
        !isNaN(opts.height * 1) ? styleH = 'height: ' + opts.height + 'px;' : opts.height == '100%' ? opts.width : null; // jshint ignore:line
        var style = 'background: ' + opts.contentBg + '; position: fixed; z-index: 20; ' + styleW + styleH;
        var tpl = '<div class="' + opts.contentName + '" style="' + style + '">' + opts.content + '</div>';
        return $(tpl);
    }

    return Popup;
}(jQuery);

/***/ }),

/***/ 1:
/***/ (function(module, exports) {

module.exports = function ($) {

    var cache = {};

    var temp = function () {
        var cache = {};

        cache = {};

        function temp(str, data) {
            // Figure out if we're getting a template, or if we need to
            // load the template - and be sure to cache the result.

            var fn = !/\W/.test(str) ? cache[str] = cache[str] || temp(document.getElementById(str).innerHTML) :

            // Generate a reusable function that will serve as a template
            // generator (and which will be cached).
            new Function("obj", "var p=[],\n\tprint=function(){p.push.apply(p,arguments);};\n" +

            // Introduce the data as local variables using with(){}
            "\nwith(obj){\np.push('" +

            // Convert the template into pure JavaScript
            str.replace(/[\r\t\n]/g, " ").split("<%").join("\t").replace(/((^|%>)[^\t]*)'/g, "$1\r").replace(/\t=(.*?)%>/g, "',\n$1,\n'").split("\t").join("');\n").split("%>").join("\np.push('").split("\r").join("\\'") + "');\n}\nreturn p.join('');");

            // Provide some basic currying to the user
            return data ? fn(data) : fn;
        }

        return {
            temp: temp
        };
    }();

    $.temp = temp.temp;

    return $.temp;
}(jQuery);

/***/ }),

/***/ 26:
/***/ (function(module, exports, __webpack_require__) {

$(function () {
    var Popup = __webpack_require__(0),
        temp = __webpack_require__(1),
        data_id;

    // 弹框模板
    $confirmPop = new Popup({
        width: 400,
        height: 225,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#confirmTpl').html()
    });

    // 删除点击
    $('.delete').on('click', function () {
        data_id = $(this).data('id');
        var opt = { data: {} };
        $confirmPop.showPop(opt);
        return false;
    });

    // 取消
    $(document).on('click', '#dialog_cancel', function () {
        $confirmPop.closePop();
    });

    // 确认
    $(document).on('click', '#dialog_confirm', function () {
        alert('点击了确认');
    });
});

/***/ }),

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(26);


/***/ })

/******/ });