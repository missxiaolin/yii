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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

$(function () {

    var Popup = __webpack_require__(4);
    var service = __webpack_require__(5);

    // 引入验证类
    __webpack_require__(12);

    $successPop = new Popup({
        width: 200,
        height: 150,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#successTpl').html()
    });

    $loadingPop = new Popup({
        width: 128,
        height: 128,
        contentBg: 'transparent',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#loadingTpl').html()
    });

    $promptPop = new Popup({
        width: 400,
        height: 225,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#promptTpl').html()
    });

    // 验证
    $.validate({
        form: '#form',
        validateOnBlur: false,
        onSuccess: function onSuccess($form) {
            moreValidate();
            return false;
        }
    });

    // 执行api
    function moreValidate() {
        var opt = { data: {} };
        service.login({
            data: $('#form').serialize(),
            params: $.params,
            beforeSend: function beforeSend() {
                $loadingPop.showPop(opt);
            },
            sucFn: function sucFn(data, status, xhr) {
                $loadingPop.closePop();
                $successPop.showPop(opt);
                setTimeout(skipUpdate, 2000);

                function skipUpdate() {
                    $successPop.closePop();
                    window.location.href = '/site/index';
                }
            },
            errFn: function errFn(data, status, xhr) {
                $loadingPop.closePop();
                $('.text').html(showError(data));
                $promptPop.showPop(opt);
            }
        });
    }

    // 错误信息
    function showError(data) {
        var info = '';
        var messages = [];
        var i = 0;
        for (var key in data) {
            messages.push(++i + "、" + data[key][0]);
        }
        info = messages.join('</br>');
        return info;
    }

    $(document).on('click', '#pop_close', function () {
        $promptPop.closePop();
    });
});

/***/ }),
/* 4 */
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
/* 5 */
/***/ (function(module, exports) {

module.exports = function () {
    // 登录
    var _login = function login(opts) {
        $.http({
            type: 'POST',
            url: '/api/user/user/login',
            data: opts.data,
            dataType: 'json',
            beforeSend: opts.beforeSend,
            success: opts.sucFn,
            error: opts.errFn
        });
    };

    return {
        login: _login
    };
}();

/***/ }),
/* 6 */,
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(3);


/***/ }),
/* 8 */,
/* 9 */,
/* 10 */,
/* 11 */,
/* 12 */
/***/ (function(module, exports) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/**
 * jQuery Form Validator
 * ------------------------------------------
 * Created by Victor Jonsson <http://www.victorjonsson.se>
 *
 * @website http://formvalidator.net/
 * @license Dual licensed under the MIT or GPL Version 2 licenses
 * @version 2.2.1
 */
(function ($) {

  'use strict';

  var $window = $(window),
      _getInputParentContainer = function _getInputParentContainer($elem) {
    if ($elem.valAttr('error-msg-container')) {
      return $($elem.valAttr('error-msg-container'));
    } else {
      var $parent = $elem.parent();
      if (!$parent.hasClass('form-group')) {
        var $formGroup = $parent.closest('.form-group');
        if ($formGroup.length) {
          return $formGroup.eq(0);
        }
      }
      return $parent;
    }
  },
      _applyErrorStyle = function _applyErrorStyle($elem, conf) {
    $elem.addClass(conf.errorElementClass).removeClass('valid');

    _getInputParentContainer($elem).addClass(conf.inputParentClassOnError).removeClass(conf.inputParentClassOnSuccess);

    if (conf.borderColorOnError !== '') {
      $elem.css('border-color', conf.borderColorOnError);
    }
  },
      _removeErrorStyle = function _removeErrorStyle($elem, conf) {
    $elem.each(function () {
      var $this = $(this);

      _setInlineErrorMessage($this, '', conf, conf.errorMessagePosition);

      $this.removeClass('valid').removeClass(conf.errorElementClass).css('border-color', '');

      _getInputParentContainer($this).removeClass(conf.inputParentClassOnError).removeClass(conf.inputParentClassOnSuccess).find('.' + conf.errorMessageClass) // remove inline span holding error message
      .remove();
    });
  },
      _setInlineErrorMessage = function _setInlineErrorMessage($input, mess, conf, $messageContainer) {
    var custom = document.getElementById($input.attr('name') + '_err_msg');
    if (custom) {
      custom.innerHTML = mess;
    } else if ((typeof $messageContainer === 'undefined' ? 'undefined' : _typeof($messageContainer)) == 'object') {
      var $found = false;
      $messageContainer.find('.' + conf.errorMessageClass).each(function () {
        if (this.inputReferer == $input[0]) {
          $found = $(this);
          return false;
        }
      });
      if ($found) {
        if (!mess) {
          $found.remove();
        } else {
          $found.html(mess);
        }
      } else {
        var $mess = $('<div class="' + conf.errorMessageClass + '">' + mess + '</div>');
        $mess[0].inputReferer = $input[0];
        $messageContainer.prepend($mess);
      }
    } else {

      var $parent = _getInputParentContainer($input),
          $mess = $parent.find('.' + conf.errorMessageClass + '.help-block');

      if ($mess.length == 0) {
        $mess = $('<span></span>').addClass('help-block').addClass(conf.errorMessageClass);
        $mess.appendTo($parent);
      }
      $mess.html(mess);
    }
  },
      _templateMessage = function _templateMessage($form, title, errorMessages, conf) {
    var messages = conf.errorMessageTemplate.messages.replace(/\{errorTitle\}/g, title),
        fields = [],
        container;

    $.each(errorMessages, function (i, msg) {
      fields.push(conf.errorMessageTemplate.field.replace(/\{msg\}/g, msg));
    });

    messages = messages.replace(/\{fields\}/g, fields.join(''));
    container = conf.errorMessageTemplate.container.replace(/\{errorMessageClass\}/g, conf.errorMessageClass);
    container = container.replace(/\{messages\}/g, messages);
    $form.children().eq(0).before(container);
  };

  /**
   * Assigns validateInputOnBlur function to elements blur event
   *
   * @param {Object} language Optional, will override $.formUtils.LANG
   * @param {Object} settings Optional, will override the default settings
   * @return {jQuery}
   */
  $.fn.validateOnBlur = function (language, settings) {
    this.find('input[data-validation],textarea[data-validation],select[data-validation]').bind('blur.validation', function () {
      $(this).validateInputOnBlur(language, settings, true, 'blur');
    });
    if (settings.validateCheckboxRadioOnClick) {
      // bind click event to validate on click for radio & checkboxes for nice UX
      this.find('input[type=checkbox][data-validation],input[type=radio][data-validation]').bind('click.validation', function () {
        $(this).validateInputOnBlur(language, settings, true, 'click');
      });
    }

    return this;
  };

  /*
   * Assigns validateInputOnBlur function to elements custom event
   * @param {Object} language Optional, will override $.formUtils.LANG
   * @param {Object} settings Optional, will override the default settings
   * * @return {jQuery}
   */
  $.fn.validateOnEvent = function (language, settings) {
    this.find('input[data-validation][data-validation-event],textarea[data-validation][data-validation-event],select[data-validation][data-validation-event]').each(function () {
      var $el = $(this),
          etype = $el.valAttr("event");
      if (etype) {
        $el.bind(etype + ".validation", function () {
          $(this).validateInputOnBlur(language, settings, true, etype);
        });
      }
    });
    return this;
  };

  /**
   * fade in help message when input gains focus
   * fade out when input loses focus
   * <input data-help="The info that I want to display for the user when input is focused" ... />
   *
   * @param {String} attrName - Optional, default is data-help
   * @return {jQuery}
   */
  $.fn.showHelpOnFocus = function (attrName) {
    if (!attrName) {
      attrName = 'data-validation-help';
    }

    // Remove previously added event listeners
    this.find('.has-help-txt').valAttr('has-keyup-event', false).removeClass('has-help-txt');

    // Add help text listeners
    this.find('textarea,input').each(function () {
      var $elem = $(this),
          className = 'jquery_form_help_' + ($elem.attr('name') || '').replace(/(:|\.|\[|\])/g, ""),
          help = $elem.attr(attrName);

      if (help) {
        $elem.addClass('has-help-txt').unbind('focus.help').bind('focus.help', function () {
          var $help = $elem.parent().find('.' + className);
          if ($help.length == 0) {
            $help = $('<span />').addClass(className).addClass('help').addClass('help-block') // twitter bs
            .text(help).hide();

            $elem.after($help);
          }
          $help.fadeIn();
        }).unbind('blur.help').bind('blur.help', function () {
          $(this).parent().find('.' + className).fadeOut('slow');
        });
      }
    });

    return this;
  };

  /**
   * Validate single input when it loses focus
   * shows error message in a span element
   * that is appended to the parent element
   *
   * @param {Object} [language] Optional, will override $.formUtils.LANG
   * @param {Object} [conf] Optional, will override the default settings
   * @param {Boolean} attachKeyupEvent Optional
   * @param {String} eventType
   * @return {jQuery}
   */
  $.fn.validateInputOnBlur = function (language, conf, attachKeyupEvent, eventType) {

    $.formUtils.eventType = eventType;

    if ((this.valAttr('suggestion-nr') || this.valAttr('postpone') || this.hasClass('hasDatepicker')) && !window.postponedValidation) {
      // This validation has to be postponed
      var _self = this,
          postponeTime = this.valAttr('postpone') || 200;

      window.postponedValidation = function () {
        _self.validateInputOnBlur(language, conf, attachKeyupEvent, eventType);
        window.postponedValidation = false;
      };

      setTimeout(function () {
        if (window.postponedValidation) {
          window.postponedValidation();
        }
      }, postponeTime);

      return this;
    }

    language = $.extend({}, $.formUtils.LANG, language || {});
    _removeErrorStyle(this, conf);

    var $elem = this,
        $form = $elem.closest("form"),
        validationRule = $elem.attr(conf.validationRuleAttribute),
        result = $.formUtils.validateInput($elem, language, conf, //$.extend({}, conf, {errorMessagePosition: 'element'}),
    $form, eventType);

    if (result.isValid) {
      if (result.shouldChangeDisplay) {
        $elem.addClass('valid');
        _getInputParentContainer($elem).addClass(conf.inputParentClassOnSuccess);
      }
    } else if (!result.isValid) {

      _applyErrorStyle($elem, conf);
      _setInlineErrorMessage($elem, result.errorMsg, conf, conf.errorMessagePosition);

      if (attachKeyupEvent) {
        $elem.unbind('keyup.validation').bind('keyup.validation', function () {
          $(this).validateInputOnBlur(language, conf, false, 'keyup');
        });
      }
    }

    return this;
  };

  /**
   * Short hand for fetching/adding/removing element attributes
   * prefixed with 'data-validation-'
   *
   * @param {String} name
   * @param {String|Boolean} [val]
   * @return string|undefined
   * @protected
   */
  $.fn.valAttr = function (name, val) {
    if (val === undefined) {
      return this.attr('data-validation-' + name);
    } else if (val === false || val === null) {
      return this.removeAttr('data-validation-' + name);
    } else {
      if (name.length > 0) name = '-' + name;
      return this.attr('data-validation' + name, val);
    }
  };

  /**
   * Function that validates all inputs in active form
   *
   * @param {Object} [language]
   * @param {Object} [conf]
   * @param {Boolean} [displayError] Defaults to true
   */
  $.fn.isValid = function (language, conf, displayError) {

    if ($.formUtils.isLoadingModules) {
      var $self = this;
      setTimeout(function () {
        $self.isValid(language, conf, displayError);
      }, 200);
      return null;
    }

    conf = $.extend({}, $.formUtils.defaultConfig(), conf || {});
    language = $.extend({}, $.formUtils.LANG, language || {});
    displayError = displayError !== false;

    if ($.formUtils.errorDisplayPreventedWhenHalted) {
      // isValid() was called programmatically with argument displayError set
      // to false when the validation was halted by any of the validators
      delete $.formUtils.errorDisplayPreventedWhenHalted;
      displayError = false;
    }

    $.formUtils.isValidatingEntireForm = true;
    $.formUtils.haltValidation = false;

    /**
     * Adds message to error message stack if not already in the message stack
     *
     * @param {String} mess
     * @para {jQuery} $elem
     */
    var addErrorMessage = function addErrorMessage(mess, $elem) {
      if ($.inArray(mess, errorMessages) < 0) {
        errorMessages.push(mess);
      }
      errorInputs.push($elem);
      $elem.attr('current-error', mess);
      if (displayError) _applyErrorStyle($elem, conf);
    },


    /** Holds inputs (of type checkox or radio) already validated, to prevent recheck of mulitple checkboxes & radios */
    checkedInputs = [],


    /** Error messages for this validation */
    errorMessages = [],


    /** Input elements which value was not valid */
    errorInputs = [],


    /** Form instance */
    $form = this,


    /**
     * Tells whether or not to validate element with this name and of this type
     *
     * @param {String} name
     * @param {String} type
     * @return {Boolean}
     */
    ignoreInput = function ignoreInput(name, type) {
      if (type === 'submit' || type === 'button' || type == 'reset') {
        return true;
      }
      return $.inArray(name, conf.ignore || []) > -1;
    };

    // Reset style and remove error class
    if (displayError) {
      $form.find('.' + conf.errorMessageClass + '.alert').remove();
      _removeErrorStyle($form.find('.' + conf.errorElementClass + ',.valid'), conf);
    }

    // Validate element values
    $form.find('input,textarea,select').filter(':not([type="submit"],[type="button"])').each(function () {
      var $elem = $(this),
          elementType = $elem.attr('type'),
          isCheckboxOrRadioBtn = elementType == 'radio' || elementType == 'checkbox',
          elementName = $elem.attr('name');

      if (!ignoreInput(elementName, elementType) && (!isCheckboxOrRadioBtn || $.inArray(elementName, checkedInputs) < 0)) {

        if (isCheckboxOrRadioBtn) checkedInputs.push(elementName);

        var result = $.formUtils.validateInput($elem, language, conf, $form, 'submit');

        if (result.shouldChangeDisplay) {
          if (!result.isValid) {
            addErrorMessage(result.errorMsg, $elem);
          } else if (result.isValid) {
            $elem.valAttr('current-error', false).addClass('valid');

            _getInputParentContainer($elem).addClass(conf.inputParentClassOnSuccess);
          }
        }
      }
    });

    // Run validation callback
    if (typeof conf.onValidate == 'function') {
      var errors = conf.onValidate($form);
      if ($.isArray(errors)) {
        $.each(errors, function (i, err) {
          addErrorMessage(err.message, err.element);
        });
      } else if (errors && errors.element && errors.message) {
        addErrorMessage(errors.message, errors.element);
      }
    }

    // Reset form validation flag
    $.formUtils.isValidatingEntireForm = false;

    // Validation failed
    if (!$.formUtils.haltValidation && errorInputs.length > 0) {

      if (displayError) {
        // display all error messages in top of form
        if (conf.errorMessagePosition === 'top') {
          _templateMessage($form, language.errorTitle, errorMessages, conf);
        }
        // Customize display message
        else if (conf.errorMessagePosition === 'custom') {
            if (typeof conf.errorMessageCustom === 'function') {
              conf.errorMessageCustom($form, language.errorTitle, errorMessages, conf);
            }
          }
          // Display error message below input field or in defined container
          else {
              $.each(errorInputs, function (i, $input) {
                _setInlineErrorMessage($input, $input.attr('current-error'), conf, conf.errorMessagePosition);
              });
            }

        if (conf.scrollToTopOnError) {
          $window.scrollTop($form.offset().top - 20);
        }
      }

      return false;
    }

    if (!displayError && $.formUtils.haltValidation) {
      $.formUtils.errorDisplayPreventedWhenHalted = true;
    }

    return !$.formUtils.haltValidation;
  };

  /**
   * @deprecated
   * @param language
   * @param conf
   */
  $.fn.validateForm = function (language, conf) {
    if (window.console && typeof window.console.warn == 'function') {
      window.console.warn('Use of deprecated function $.validateForm, use $.isValid instead');
    }
    return this.isValid(language, conf, true);
  };

  /**
   * Plugin for displaying input length restriction
   */
  $.fn.restrictLength = function (maxLengthElement) {
    new $.formUtils.lengthRestriction(this, maxLengthElement);
    return this;
  };

  /**
   * Add suggestion dropdown to inputs having data-suggestions with a comma
   * separated string with suggestions
   * @param {Array} [settings]
   * @returns {jQuery}
   */
  $.fn.addSuggestions = function (settings) {
    var sugs = false;
    this.find('input').each(function () {
      var $field = $(this);

      sugs = $.split($field.attr('data-suggestions'));

      if (sugs.length > 0 && !$field.hasClass('has-suggestions')) {
        $.formUtils.suggest($field, sugs, settings);
        $field.addClass('has-suggestions');
      }
    });
    return this;
  };

  /**
   * A bit smarter split function
   * delimiter can be space, comma, dash or pipe
   * @param {String} val
   * @param {Function|String} [callback]
   * @returns {Array|void}
   */
  $.split = function (val, callback) {
    if (typeof callback != 'function') {
      // return array
      if (!val) return [];
      var values = [];
      $.each(val.split(callback ? callback : /[,|\-\s]\s*/g), function (i, str) {
        str = $.trim(str);
        if (str.length) values.push(str);
      });
      return values;
    } else if (val) {
      // exec callback func on each
      $.each(val.split(/[,|\-\s]\s*/g), function (i, str) {
        str = $.trim(str);
        if (str.length) return callback(str, i);
      });
    }
  };

  /**
   * Short hand function that makes the validation setup require less code
   * @param conf
   */
  $.validate = function (conf) {

    var defaultConf = $.extend($.formUtils.defaultConfig(), {
      form: 'form',
      /*
       * Enable custom event for validation
       */
      validateOnEvent: true,
      validateOnBlur: true,
      validateCheckboxRadioOnClick: true,
      showHelpOnFocus: true,
      addSuggestions: true,
      modules: '',
      onModulesLoaded: null,
      language: false,
      onSuccess: false,
      onError: false,
      onElementValidate: false
    });

    conf = $.extend(defaultConf, conf || {});

    // Add validation to forms
    $(conf.form).each(function (i, form) {

      var $form = $(form);
      $window.trigger('formValidationSetup', [$form]);

      // Remove all event listeners previously added
      $form.find('.has-help-txt').unbind('focus.validation').unbind('blur.validation');

      $form.removeClass('has-validation-callback').unbind('submit.validation').unbind('reset.validation').find('input[data-validation],textarea[data-validation]').unbind('blur.validation');

      // Validate when submitted
      $form.bind('submit.validation', function () {
        var $form = $(this);

        if ($.formUtils.haltValidation) {
          // pressing several times on submit button while validation is halted
          return false;
        }

        if ($.formUtils.isLoadingModules) {
          setTimeout(function () {
            $form.trigger('submit.validation');
          }, 200);
          return false;
        }

        var valid = $form.isValid(conf.language, conf);

        if ($.formUtils.haltValidation) {
          // Validation got halted by one of the validators
          return false;
        } else {
          if (valid && typeof conf.onSuccess == 'function') {
            var callbackResponse = conf.onSuccess($form);
            if (callbackResponse === false) return false;
          } else if (!valid && typeof conf.onError == 'function') {
            conf.onError($form);
            return false;
          } else {
            return valid;
          }
        }
      }).bind('reset.validation', function () {
        // remove messages
        $(this).find('.' + conf.errorMessageClass + '.alert').remove();
        _removeErrorStyle($(this).find('.' + conf.errorElementClass + ',.valid'), conf);
      }).addClass('has-validation-callback');

      if (conf.showHelpOnFocus) {
        $form.showHelpOnFocus();
      }
      if (conf.addSuggestions) {
        $form.addSuggestions();
      }
      if (conf.validateOnBlur) {
        $form.validateOnBlur(conf.language, conf);
        $form.bind('html5ValidationAttrsFound', function () {
          $form.validateOnBlur(conf.language, conf);
        });
      }
      if (conf.validateOnEvent) {
        $form.validateOnEvent(conf.language, conf);
      }
    });

    if (conf.modules != '') {
      if (typeof conf.onModulesLoaded == 'function') {
        $window.one('validatorsLoaded', conf.onModulesLoaded);
      }
      $.formUtils.loadModules(conf.modules);
    }
  };

  /**
   * Object containing utility methods for this plugin
   */
  $.formUtils = {

    /**
     * Default config for $(...).isValid();
     */
    defaultConfig: function defaultConfig() {
      return {
        ignore: [], // Names of inputs not to be validated even though node attribute containing the validation rules tells us to
        errorElementClass: 'error', // Class that will be put on elements which value is invalid
        borderColorOnError: 'red', // Border color of elements which value is invalid, empty string to not change border color
        errorMessageClass: 'form-error', // class name of div containing error messages when validation fails
        validationRuleAttribute: 'data-validation', // name of the attribute holding the validation rules
        validationErrorMsgAttribute: 'data-validation-error-msg', // define custom err msg inline with element
        errorMessagePosition: 'element', // Can be either "top" or "element" or "custom"
        errorMessageTemplate: {
          container: '<div class="{errorMessageClass} alert alert-danger">{messages}</div>',
          messages: '<strong>{errorTitle}</strong><ul>{fields}</ul>',
          field: '<li>{msg}</li>'
        },
        errorMessageCustom: _templateMessage,
        scrollToTopOnError: true,
        dateFormat: 'yyyy-mm-dd',
        addValidClassOnAll: false, // whether or not to apply class="valid" even if the input wasn't validated
        decimalSeparator: '.',
        inputParentClassOnError: 'has-error', // twitter-bootstrap default class name
        inputParentClassOnSuccess: 'has-success' // twitter-bootstrap default class name
      };
    },

    /**
     * Available validators
     */
    validators: {},

    /**
     * Events triggered by form validator
     */
    _events: { load: [], valid: [], invalid: [] },

    /**
     * Setting this property to true during validation will
     * stop further validation from taking place and form will
     * not be sent
     */
    haltValidation: false,

    /**
     * This variable will be true $.fn.isValid() is called
     * and false when $.fn.validateOnBlur is called
     */
    isValidatingEntireForm: false,

    /**
     * Function for adding a validator
     * @param {Object} validator
     */
    addValidator: function addValidator(validator) {
      // prefix with "validate_" for backward compatibility reasons
      var name = validator.name.indexOf('validate_') === 0 ? validator.name : 'validate_' + validator.name;
      if (validator.validateOnKeyUp === undefined) validator.validateOnKeyUp = true;
      this.validators[name] = validator;
    },

    /**
     * @var {Boolean}
     */
    isLoadingModules: false,

    /**
     * @var {Object}
     */
    loadedModules: {},

    /**
     * @example
     *  $.formUtils.loadModules('date, security.dev');
     *
     * Will load the scripts date.js and security.dev.js from the
     * directory where this script resides. If you want to load
     * the modules from another directory you can use the
     * path argument.
     *
     * The script will be cached by the browser unless the module
     * name ends with .dev
     *
     * @param {String} modules - Comma separated string with module file names (no directory nor file extension)
     * @param {String} [path] - Optional, path where the module files is located if their not in the same directory as the core modules
     * @param {Boolean} [fireEvent] - Optional, whether or not to fire event 'load' when modules finished loading
     */
    loadModules: function loadModules(modules, path, fireEvent) {

      if (fireEvent === undefined) fireEvent = true;

      if ($.formUtils.isLoadingModules) {
        setTimeout(function () {
          $.formUtils.loadModules(modules, path, fireEvent);
        });
        return;
      }

      var hasLoadedAnyModule = false,
          loadModuleScripts = function loadModuleScripts(modules, path) {

        var moduleList = $.split(modules, ','),
            numModules = moduleList.length,
            moduleLoadedCallback = function moduleLoadedCallback() {
          numModules--;
          if (numModules == 0) {
            $.formUtils.isLoadingModules = false;
            if (fireEvent && hasLoadedAnyModule) {
              $window.trigger('validatorsLoaded');
            }
          }
        };

        if (numModules > 0) {
          $.formUtils.isLoadingModules = true;
        }

        var cacheSuffix = '?__=' + new Date().getTime(),
            appendToElement = document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0];

        $.each(moduleList, function (i, modName) {
          modName = $.trim(modName);
          if (modName.length == 0) {
            moduleLoadedCallback();
          } else {
            var scriptUrl = path + modName + (modName.slice(-3) == '.js' ? '' : '.js'),
                script = document.createElement('SCRIPT');

            if (scriptUrl in $.formUtils.loadedModules) {
              // already loaded
              moduleLoadedCallback();
            } else {

              // Remember that this script is loaded
              $.formUtils.loadedModules[scriptUrl] = 1;
              hasLoadedAnyModule = true;

              // Load the script
              script.type = 'text/javascript';
              script.onload = moduleLoadedCallback;
              script.src = scriptUrl + (scriptUrl.slice(-7) == '.dev.js' ? cacheSuffix : '');
              script.onreadystatechange = function () {
                // IE 7 fix
                if (this.readyState == 'complete' || this.readyState == 'loaded') {
                  moduleLoadedCallback();
                  // Handle memory leak in IE
                  this.onload = null;
                  this.onreadystatechange = null;
                }
              };
              appendToElement.appendChild(script);
            }
          }
        });
      };

      if (path) {
        loadModuleScripts(modules, path);
      } else {
        var findScriptPathAndLoadModules = function findScriptPathAndLoadModules() {
          var foundPath = false;
          $('script[src*="form-validator"]').each(function () {
            foundPath = this.src.substr(0, this.src.lastIndexOf('/')) + '/';
            if (foundPath == '/') foundPath = '';
            return false;
          });

          if (foundPath !== false) {
            loadModuleScripts(modules, foundPath);
            return true;
          }
          return false;
        };

        if (!findScriptPathAndLoadModules()) {
          $(findScriptPathAndLoadModules);
        }
      }
    },

    /**
     * Validate the value of given element according to the validation rules
     * found in the attribute data-validation. Will return null if no validation
     * should take place, returns true if valid or error message if not valid
     *
     * @param {jQuery} $elem
     * @param {Object} language ($.formUtils.LANG)
     * @param {Object} conf
     * @param {jQuery} $form
     * @param {String} [eventContext]
     * @return {Object} REtur
     */
    validateInput: function validateInput($elem, language, conf, $form, eventContext) {

      $elem.trigger('beforeValidation');

      var value = $elem.val() || '',
          result = { isValid: true, shouldChangeDisplay: true, errorMsg: '' },
          optional = $elem.valAttr('optional'),


      // test if a checkbox forces this element to be validated
      validationDependsOnCheckedInput = false,
          validationDependentInputIsChecked = false,
          validateIfCheckedElement = false,


      // get value of this element's attribute "... if-checked"
      validateIfCheckedElementName = $elem.valAttr('if-checked');

      if ($elem.attr('disabled')) {
        result.shouldChangeDisplay = false;
        return result;
      }

      // make sure we can proceed
      if (validateIfCheckedElementName != null) {

        // Set the boolean telling us that the validation depends
        // on another input being checked
        validationDependsOnCheckedInput = true;

        // select the checkbox type element in this form
        validateIfCheckedElement = $form.find('input[name="' + validateIfCheckedElementName + '"]');

        // test if it's property "checked" is checked
        if (validateIfCheckedElement.prop('checked')) {
          // set value for validation checkpoint
          validationDependentInputIsChecked = true;
        }
      }

      // validation checkpoint
      // if empty AND optional attribute is present
      // OR depending on a checkbox being checked AND checkbox is checked, return true
      if (!value && optional === 'true' || validationDependsOnCheckedInput && !validationDependentInputIsChecked) {
        result.shouldChangeDisplay = conf.addValidClassOnAll;
        return result;
      }

      var validationRules = $elem.attr(conf.validationRuleAttribute),


      // see if form element has inline err msg attribute
      validationErrorMsg = true;

      if (!validationRules) {
        result.shouldChangeDisplay = conf.addValidClassOnAll;
        return result;
      }

      $.split(validationRules, function (rule) {
        if (rule.indexOf('validate_') !== 0) {
          rule = 'validate_' + rule;
        }

        var validator = $.formUtils.validators[rule];

        if (validator && typeof validator['validatorFunction'] == 'function') {

          // special change of element for checkbox_group rule
          if (rule == 'validate_checkbox_group') {
            // set element to first in group, so error msg attr doesn't need to be set on all elements in group
            $elem = $form.find("[name='" + $elem.attr('name') + "']:eq(0)");
          }

          var isValid = null;
          if (eventContext != 'keyup' || validator.validateOnKeyUp) {
            isValid = validator.validatorFunction(value, $elem, conf, language, $form);
          }

          if (!isValid) {
            validationErrorMsg = null;
            if (isValid !== null) {
              validationErrorMsg = $elem.attr(conf.validationErrorMsgAttribute + '-' + rule.replace('validate_', ''));
              if (!validationErrorMsg) {
                validationErrorMsg = $elem.attr(conf.validationErrorMsgAttribute);
                if (!validationErrorMsg) {
                  validationErrorMsg = language[validator.errorMessageKey];
                  if (!validationErrorMsg) validationErrorMsg = validator.errorMessage;
                }
              }
            }
            return false; // break iteration
          }
        } else {
          throw new Error('Using undefined validator "' + rule + '"');
        }
      }, ' ');

      if (typeof validationErrorMsg == 'string') {
        $elem.trigger('validation', false);
        result.errorMsg = validationErrorMsg;
        result.isValid = false;
        result.shouldChangeDisplay = true;
      } else if (validationErrorMsg === null) {
        result.shouldChangeDisplay = conf.addValidClassOnAll;
      } else {
        $elem.trigger('validation', true);
        result.shouldChangeDisplay = true;
      }

      // Run element validation callback
      if (typeof conf.onElementValidate == 'function' && result !== null) {
        conf.onElementValidate(result.isValid, $elem, $form, validationErrorMsg);
      }

      return result;
    },

    /**
     * Is it a correct date according to given dateFormat. Will return false if not, otherwise
     * an array 0=>year 1=>month 2=>day
     *
     * @param {String} val
     * @param {String} dateFormat
     * @return {Array}|{Boolean}
     */
    parseDate: function parseDate(val, dateFormat) {
      var divider = dateFormat.replace(/[a-zA-Z]/gi, '').substring(0, 1),
          regexp = '^',
          formatParts = dateFormat.split(divider || null),
          matches,
          day,
          month,
          year;

      $.each(formatParts, function (i, part) {
        regexp += (i > 0 ? '\\' + divider : '') + '(\\d{' + part.length + '})';
      });

      regexp += '$';

      matches = val.match(new RegExp(regexp));
      if (matches === null) {
        return false;
      }

      var findDateUnit = function findDateUnit(unit, formatParts, matches) {
        for (var i = 0; i < formatParts.length; i++) {
          if (formatParts[i].substring(0, 1) === unit) {
            return $.formUtils.parseDateInt(matches[i + 1]);
          }
        }
        return -1;
      };

      month = findDateUnit('m', formatParts, matches);
      day = findDateUnit('d', formatParts, matches);
      year = findDateUnit('y', formatParts, matches);

      if (month === 2 && day > 28 && (year % 4 !== 0 || year % 100 === 0 && year % 400 !== 0) || month === 2 && day > 29 && (year % 4 === 0 || year % 100 !== 0 && year % 400 === 0) || month > 12 || month === 0) {
        return false;
      }
      if (this.isShortMonth(month) && day > 30 || !this.isShortMonth(month) && day > 31 || day === 0) {
        return false;
      }

      return [year, month, day];
    },

    /**
     * skum fix. är talet 05 eller lägre ger parseInt rätt int annars får man 0 när man kör parseInt?
     *
     * @param {String} val
     * @param {Number}
     */
    parseDateInt: function parseDateInt(val) {
      if (val.indexOf('0') === 0) {
        val = val.replace('0', '');
      }
      return parseInt(val, 10);
    },

    /**
     * Has month only 30 days?
     *
     * @param {Number} m
     * @return {Boolean}
     */
    isShortMonth: function isShortMonth(m) {
      return m % 2 === 0 && m < 7 || m % 2 !== 0 && m > 7;
    },

    /**
     * Restrict input length
     *
     * @param {jQuery} $inputElement Jquery Html object
     * @param {jQuery} $maxLengthElement jQuery Html Object
     * @return void
     */
    lengthRestriction: function lengthRestriction($inputElement, $maxLengthElement) {
      // read maxChars from counter display initial text value
      var maxChars = parseInt($maxLengthElement.text(), 10),
          charsLeft = 0,


      // internal function does the counting and sets display value
      countCharacters = function countCharacters() {
        var numChars = $inputElement.val().length;
        if (numChars > maxChars) {
          // get current scroll bar position
          var currScrollTopPos = $inputElement.scrollTop();
          // trim value to max length
          $inputElement.val($inputElement.val().substring(0, maxChars));
          $inputElement.scrollTop(currScrollTopPos);
        }
        charsLeft = maxChars - numChars;
        if (charsLeft < 0) charsLeft = 0;

        // set counter text
        $maxLengthElement.text(charsLeft);
      };

      // bind events to this element
      // setTimeout is needed, cut or paste fires before val is available
      $($inputElement).bind('keydown keyup keypress focus blur', countCharacters).bind('cut paste', function () {
        setTimeout(countCharacters, 100);
      });

      // count chars on pageload, if there are prefilled input-values
      $(document).bind("ready", countCharacters);
    },

    /**
     * Test numeric against allowed range
     *
     * @param $value int
     * @param $rangeAllowed str; (1-2, min1, max2)
     * @return array
     */
    numericRangeCheck: function numericRangeCheck(value, rangeAllowed) {
      // split by dash
      var range = $.split(rangeAllowed);
      // min or max
      var minmax = parseInt(rangeAllowed.substr(3), 10);
      // range ?
      if (range.length == 2 && (value < parseInt(range[0], 10) || value > parseInt(range[1], 10))) {
        return ["out", range[0], range[1]];
      } // value is out of range
      else if (rangeAllowed.indexOf('min') === 0 && value < minmax) // min
          {
            return ["min", minmax];
          } // value is below min
        else if (rangeAllowed.indexOf('max') === 0 && value > minmax) // max
            {
              return ["max", minmax];
            } // value is above max
      // since no other returns executed, value is in allowed range
      return ["ok"];
    },

    _numSuggestionElements: 0,
    _selectedSuggestion: null,
    _previousTypedVal: null,

    /**
     * Utility function that can be used to create plugins that gives
     * suggestions when inputs is typed into
     * @param {jQuery} $elem
     * @param {Array} suggestions
     * @param {Object} settings - Optional
     * @return {jQuery}
     */
    suggest: function suggest($elem, suggestions, settings) {
      var conf = {
        css: {
          maxHeight: '150px',
          background: '#FFF',
          lineHeight: '150%',
          textDecoration: 'underline',
          overflowX: 'hidden',
          overflowY: 'auto',
          border: '#CCC solid 1px',
          borderTop: 'none',
          cursor: 'pointer'
        },
        activeSuggestionCSS: {
          background: '#E9E9E9'
        }
      },
          setSuggsetionPosition = function setSuggsetionPosition($suggestionContainer, $input) {
        var offset = $input.offset();
        $suggestionContainer.css({
          width: $input.outerWidth(),
          left: offset.left + 'px',
          top: offset.top + $input.outerHeight() + 'px'
        });
      };

      if (settings) $.extend(conf, settings);

      conf.css['position'] = 'absolute';
      conf.css['z-index'] = 9999;
      $elem.attr('autocomplete', 'off');

      if (this._numSuggestionElements === 0) {
        // Re-position suggestion container if window size changes
        $window.bind('resize', function () {
          $('.jquery-form-suggestions').each(function () {
            var $container = $(this),
                suggestID = $container.attr('data-suggest-container');
            setSuggsetionPosition($container, $('.suggestions-' + suggestID).eq(0));
          });
        });
      }

      this._numSuggestionElements++;

      var onSelectSuggestion = function onSelectSuggestion($el) {
        var suggestionId = $el.valAttr('suggestion-nr');
        $.formUtils._selectedSuggestion = null;
        $.formUtils._previousTypedVal = null;
        $('.jquery-form-suggestion-' + suggestionId).fadeOut('fast');
      };

      $elem.data('suggestions', suggestions).valAttr('suggestion-nr', this._numSuggestionElements).unbind('focus.suggest').bind('focus.suggest', function () {
        $(this).trigger('keyup');
        $.formUtils._selectedSuggestion = null;
      }).unbind('keyup.suggest').bind('keyup.suggest', function () {
        var $input = $(this),
            foundSuggestions = [],
            val = $.trim($input.val()).toLocaleLowerCase();

        if (val == $.formUtils._previousTypedVal) {
          return;
        } else {
          $.formUtils._previousTypedVal = val;
        }

        var hasTypedSuggestion = false,
            suggestionId = $input.valAttr('suggestion-nr'),
            $suggestionContainer = $('.jquery-form-suggestion-' + suggestionId);

        $suggestionContainer.scrollTop(0);

        // Find the right suggestions
        if (val != '') {
          var findPartial = val.length > 2;
          $.each($input.data('suggestions'), function (i, suggestion) {
            var lowerCaseVal = suggestion.toLocaleLowerCase();
            if (lowerCaseVal == val) {
              foundSuggestions.push('<strong>' + suggestion + '</strong>');
              hasTypedSuggestion = true;
              return false;
            } else if (lowerCaseVal.indexOf(val) === 0 || findPartial && lowerCaseVal.indexOf(val) > -1) {
              foundSuggestions.push(suggestion.replace(new RegExp(val, 'gi'), '<strong>$&</strong>'));
            }
          });
        }

        // Hide suggestion container
        if (hasTypedSuggestion || foundSuggestions.length == 0 && $suggestionContainer.length > 0) {
          $suggestionContainer.hide();
        }

        // Create suggestion container if not already exists
        else if (foundSuggestions.length > 0 && $suggestionContainer.length == 0) {
            $suggestionContainer = $('<div></div>').css(conf.css).appendTo('body');
            $elem.addClass('suggestions-' + suggestionId);
            $suggestionContainer.attr('data-suggest-container', suggestionId).addClass('jquery-form-suggestions').addClass('jquery-form-suggestion-' + suggestionId);
          }

          // Show hidden container
          else if (foundSuggestions.length > 0 && !$suggestionContainer.is(':visible')) {
              $suggestionContainer.show();
            }

        // add suggestions
        if (foundSuggestions.length > 0 && val.length != foundSuggestions[0].length) {

          // put container in place every time, just in case
          setSuggsetionPosition($suggestionContainer, $input);

          // Add suggestions HTML to container
          $suggestionContainer.html('');
          $.each(foundSuggestions, function (i, text) {
            $('<div></div>').append(text).css({
              overflow: 'hidden',
              textOverflow: 'ellipsis',
              whiteSpace: 'nowrap',
              padding: '5px'
            }).addClass('form-suggest-element').appendTo($suggestionContainer).click(function () {
              $input.focus();
              $input.val($(this).text());
              onSelectSuggestion($input);
            });
          });
        }
      }).unbind('keydown.validation').bind('keydown.validation', function (e) {
        var code = e.keyCode ? e.keyCode : e.which,
            suggestionId,
            $suggestionContainer,
            $input = $(this);

        if (code == 13 && $.formUtils._selectedSuggestion !== null) {
          suggestionId = $input.valAttr('suggestion-nr');
          $suggestionContainer = $('.jquery-form-suggestion-' + suggestionId);
          if ($suggestionContainer.length > 0) {
            var newText = $suggestionContainer.find('div').eq($.formUtils._selectedSuggestion).text();
            $input.val(newText);
            onSelectSuggestion($input);
            e.preventDefault();
          }
        } else {
          suggestionId = $input.valAttr('suggestion-nr');
          $suggestionContainer = $('.jquery-form-suggestion-' + suggestionId);
          var $suggestions = $suggestionContainer.children();
          if ($suggestions.length > 0 && $.inArray(code, [38, 40]) > -1) {
            if (code == 38) {
              // key up
              if ($.formUtils._selectedSuggestion === null) $.formUtils._selectedSuggestion = $suggestions.length - 1;else $.formUtils._selectedSuggestion--;
              if ($.formUtils._selectedSuggestion < 0) $.formUtils._selectedSuggestion = $suggestions.length - 1;
            } else if (code == 40) {
              // key down
              if ($.formUtils._selectedSuggestion === null) $.formUtils._selectedSuggestion = 0;else $.formUtils._selectedSuggestion++;
              if ($.formUtils._selectedSuggestion > $suggestions.length - 1) $.formUtils._selectedSuggestion = 0;
            }

            // Scroll in suggestion window
            var containerInnerHeight = $suggestionContainer.innerHeight(),
                containerScrollTop = $suggestionContainer.scrollTop(),
                suggestionHeight = $suggestionContainer.children().eq(0).outerHeight(),
                activeSuggestionPosY = suggestionHeight * $.formUtils._selectedSuggestion;

            if (activeSuggestionPosY < containerScrollTop || activeSuggestionPosY > containerScrollTop + containerInnerHeight) {
              $suggestionContainer.scrollTop(activeSuggestionPosY);
            }

            $suggestions.removeClass('active-suggestion').css('background', 'none').eq($.formUtils._selectedSuggestion).addClass('active-suggestion').css(conf.activeSuggestionCSS);

            e.preventDefault();
            return false;
          }
        }
      }).unbind('blur.suggest').bind('blur.suggest', function () {
        onSelectSuggestion($(this));
      });

      return $elem;
    },

    /**
     * Error dialogs
     *
     * @var {Object}
     */
    LANG: {
      errorTitle: 'Form submission failed!',
      requiredFields: 'You have not answered all required fields',
      badTime: 'You have not given a correct time',
      badEmail: 'You have not given a correct e-mail address',
      badTelephone: 'You have not given a correct phone number',
      badSecurityAnswer: 'You have not given a correct answer to the security question',
      badDate: 'You have not given a correct date',
      lengthBadStart: 'The input value must be between ',
      lengthBadEnd: ' characters',
      lengthTooLongStart: 'The input value is longer than ',
      lengthTooShortStart: 'The input value is shorter than ',
      notConfirmed: 'Input values could not be confirmed',
      badDomain: 'Incorrect domain value',
      badUrl: 'The input value is not a correct URL',
      badCustomVal: 'The input value is incorrect',
      andSpaces: ' and spaces ',
      badInt: 'The input value was not a correct number',
      badSecurityNumber: 'Your social security number was incorrect',
      badUKVatAnswer: 'Incorrect UK VAT Number',
      badStrength: 'The password isn\'t strong enough',
      badNumberOfSelectedOptionsStart: 'You have to choose at least ',
      badNumberOfSelectedOptionsEnd: ' answers',
      badAlphaNumeric: 'The input value can only contain alphanumeric characters ',
      badAlphaNumericExtra: ' and ',
      wrongFileSize: 'The file you are trying to upload is too large (max %s)',
      wrongFileType: 'Only files of type %s is allowed',
      groupCheckedRangeStart: 'Please choose between ',
      groupCheckedTooFewStart: 'Please choose at least ',
      groupCheckedTooManyStart: 'Please choose a maximum of ',
      groupCheckedEnd: ' item(s)',
      badCreditCard: 'The credit card number is not correct',
      badCVV: 'The CVV number was not correct'
    }
  };

  /* * * * * * * * * * * * * * * * * * * * * *
   CORE VALIDATORS
   * * * * * * * * * * * * * * * * * * * * */

  /*
   * Validate email
   */
  $.formUtils.addValidator({
    name: 'email',
    validatorFunction: function validatorFunction(email) {

      var emailParts = email.toLowerCase().split('@');
      if (emailParts.length == 2) {
        return $.formUtils.validators.validate_domain.validatorFunction(emailParts[1]) && !/[^\w\+\.\-]/.test(emailParts[0]) && emailParts[0].length > 0;
      }

      return false;
    },
    errorMessage: '',
    errorMessageKey: 'badEmail'
  });

  /*
   * Validate domain name
   */
  $.formUtils.addValidator({
    name: 'domain',
    validatorFunction: function validatorFunction(val) {
      return val.length > 0 && val.length <= 253 && // Including sub domains
      !/[^a-zA-Z0-9]/.test(val.slice(-2)) && !/[^a-zA-Z]/.test(val.substr(0, 1)) && !/[^a-zA-Z0-9\.\-]/.test(val) && val.split('..').length == 1 && val.split('.').length > 1;
    },
    errorMessage: '',
    errorMessageKey: 'badDomain'
  });

  /*
   * Validate required
   */
  $.formUtils.addValidator({
    name: 'required',
    validatorFunction: function validatorFunction(val, $el, config, language, $form) {
      switch ($el.attr('type')) {
        case 'checkbox':
          return $el.is(':checked');
        case 'radio':
          return $form.find('input[name="' + $el.attr('name') + '"]').filter(':checked').length > 0;
        default:
          return $.trim(val) !== '';
      }
    },
    errorMessage: '',
    errorMessageKey: 'requiredFields'
  });

  /*
   * Validate length range
   */
  $.formUtils.addValidator({
    name: 'length',
    validatorFunction: function validatorFunction(val, $el, conf, lang) {
      var lengthAllowed = $el.valAttr('length'),
          type = $el.attr('type');

      if (lengthAllowed == undefined) {
        alert('Please add attribute "data-validation-length" to ' + $el[0].nodeName + ' named ' + $el.attr('name'));
        return true;
      }

      // check if length is above min, below max or within range.
      var len = type == 'file' && $el.get(0).files !== undefined ? $el.get(0).files.length : val.length,
          lengthCheckResults = $.formUtils.numericRangeCheck(len, lengthAllowed),
          checkResult;

      switch (lengthCheckResults[0]) {// outside of allowed range
        case "out":
          this.errorMessage = lang.lengthBadStart + lengthAllowed + lang.lengthBadEnd;
          checkResult = false;
          break;
        // too short
        case "min":
          this.errorMessage = lang.lengthTooShortStart + lengthCheckResults[1] + lang.lengthBadEnd;
          checkResult = false;
          break;
        // too long
        case "max":
          this.errorMessage = lang.lengthTooLongStart + lengthCheckResults[1] + lang.lengthBadEnd;
          checkResult = false;
          break;
        // ok
        default:
          checkResult = true;
      }

      return checkResult;
    },
    errorMessage: '',
    errorMessageKey: ''
  });

  /*
   * Validate url
   */
  $.formUtils.addValidator({
    name: 'url',
    validatorFunction: function validatorFunction(url) {
      // written by Scott Gonzalez: http://projects.scottsplayground.com/iri/
      // - Victor Jonsson added support for arrays in the url ?arg[]=sdfsdf
      // - General improvements made by Stéphane Moureau <https://github.com/TraderStf>
      var urlFilter = /^(https?|ftp):\/\/((((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|\[|\]|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
      if (urlFilter.test(url)) {
        var domain = url.split('://')[1],
            domainSlashPos = domain.indexOf('/');

        if (domainSlashPos > -1) domain = domain.substr(0, domainSlashPos);

        return $.formUtils.validators.validate_domain.validatorFunction(domain); // todo: add support for IP-addresses
      }
      return false;
    },
    errorMessage: '',
    errorMessageKey: 'badUrl'
  });

  /*
   * Validate number (floating or integer)
   */
  $.formUtils.addValidator({
    name: 'number',
    validatorFunction: function validatorFunction(val, $el, conf) {
      if (val !== '') {
        var allowing = $el.valAttr('allowing') || '',
            decimalSeparator = $el.valAttr('decimal-separator') || conf.decimalSeparator,
            allowsRange = false,
            begin,
            end,
            steps = $el.valAttr('step') || '',
            allowsSteps = false;

        if (allowing.indexOf('number') == -1) allowing += ',number';

        if (allowing.indexOf('negative') == -1 && val.indexOf('-') === 0) {
          return false;
        }

        if (allowing.indexOf('range') > -1) {
          begin = parseFloat(allowing.substring(allowing.indexOf("[") + 1, allowing.indexOf(";")));
          end = parseFloat(allowing.substring(allowing.indexOf(";") + 1, allowing.indexOf("]")));
          allowsRange = true;
        }

        if (steps != "") allowsSteps = true;

        if (decimalSeparator == ',') {
          if (val.indexOf('.') > -1) {
            return false;
          }
          // Fix for checking range with floats using ,
          val = val.replace(',', '.');
        }

        if (allowing.indexOf('number') > -1 && val.replace(/[0-9-]/g, '') === '' && (!allowsRange || val >= begin && val <= end) && (!allowsSteps || val % steps == 0)) {
          return true;
        }
        if (allowing.indexOf('float') > -1 && val.match(new RegExp('^([0-9-]+)\\.([0-9]+)$')) !== null && (!allowsRange || val >= begin && val <= end) && (!allowsSteps || val % steps == 0)) {
          return true;
        }
      }
      return false;
    },
    errorMessage: '',
    errorMessageKey: 'badInt'
  });

  /*
   * Validate alpha numeric
   */
  $.formUtils.addValidator({
    name: 'alphanumeric',
    validatorFunction: function validatorFunction(val, $el, conf, language) {
      var patternStart = '^([a-zA-Z0-9',
          patternEnd = ']+)$',
          additionalChars = $el.valAttr('allowing'),
          pattern = '';

      if (additionalChars) {
        pattern = patternStart + additionalChars + patternEnd;
        var extra = additionalChars.replace(/\\/g, '');
        if (extra.indexOf(' ') > -1) {
          extra = extra.replace(' ', '');
          extra += language.andSpaces || $.formUtils.LANG.andSpaces;
        }
        this.errorMessage = language.badAlphaNumeric + language.badAlphaNumericExtra + extra;
      } else {
        pattern = patternStart + patternEnd;
        this.errorMessage = language.badAlphaNumeric;
      }

      return new RegExp(pattern).test(val);
    },
    errorMessage: '',
    errorMessageKey: ''
  });

  /*
   * Validate against regexp
   */
  $.formUtils.addValidator({
    name: 'custom',
    validatorFunction: function validatorFunction(val, $el, conf) {
      var regexp = new RegExp($el.valAttr('regexp'));
      return regexp.test(val);
    },
    errorMessage: '',
    errorMessageKey: 'badCustomVal'
  });

  /*
   * Validate date
   */
  $.formUtils.addValidator({
    name: 'date',
    validatorFunction: function validatorFunction(date, $el, conf) {
      var dateFormat = $el.valAttr('format') || conf.dateFormat || 'yyyy-mm-dd';
      return $.formUtils.parseDate(date, dateFormat) !== false;
    },
    errorMessage: '',
    errorMessageKey: 'badDate'
  });

  /*
   * Validate group of checkboxes, validate qty required is checked
   * written by Steve Wasiura : http://stevewasiura.waztech.com
   * element attrs
   *    data-validation="checkbox_group"
   *    data-validation-qty="1-2"  // min 1 max 2
   *    data-validation-error-msg="chose min 1, max of 2 checkboxes"
   */
  $.formUtils.addValidator({
    name: 'checkbox_group',
    validatorFunction: function validatorFunction(val, $el, conf, lang, $form) {
      // preset return var
      var isValid = true,

      // get name of element. since it is a checkbox group, all checkboxes will have same name
      elname = $el.attr('name'),

      // get checkboxes and count the checked ones
      $checkBoxes = $("input[type=checkbox][name^='" + elname + "']", $form),
          checkedCount = $checkBoxes.filter(':checked').length,

      // get el attr that specs qty required / allowed
      qtyAllowed = $el.valAttr('qty');

      if (qtyAllowed == undefined) {
        var elementType = $el.get(0).nodeName;
        alert('Attribute "data-validation-qty" is missing from ' + elementType + ' named ' + $el.attr('name'));
      }

      // call Utility function to check if count is above min, below max, within range etc.
      var qtyCheckResults = $.formUtils.numericRangeCheck(checkedCount, qtyAllowed);

      // results will be array, [0]=result str, [1]=qty int
      switch (qtyCheckResults[0]) {
        // outside allowed range
        case "out":
          this.errorMessage = lang.groupCheckedRangeStart + qtyAllowed + lang.groupCheckedEnd;
          isValid = false;
          break;
        // below min qty
        case "min":
          this.errorMessage = lang.groupCheckedTooFewStart + qtyCheckResults[1] + lang.groupCheckedEnd;
          isValid = false;
          break;
        // above max qty
        case "max":
          this.errorMessage = lang.groupCheckedTooManyStart + qtyCheckResults[1] + lang.groupCheckedEnd;
          isValid = false;
          break;
        // ok
        default:
          isValid = true;
      }

      if (!isValid) {
        var _triggerOnBlur = function _triggerOnBlur() {
          $checkBoxes.unbind('click', _triggerOnBlur);
          $checkBoxes.filter('*[data-validation]').eq(0).validateInputOnBlur(lang, conf, false, 'blur');
        };
        //$checkBoxes.bind('click', _triggerOnBlur);
      }

      return isValid;
    }
    //   errorMessage : '', // set above in switch statement
    //   errorMessageKey: '' // not used
  });
})(jQuery);

/***/ })
/******/ ]);