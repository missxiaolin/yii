/**
 * 设置cookie
 * @param {string} name  键名
 * @param {string} value 键值
 * @param {integer} days cookie周期
 */

define(['jquery'], function ($) {

    function Cookie(options) {
    }


    /**
     * 设置cookie
     * @param name
     * @param value
     * @param days
     */
    Cookie.prototype.setCookie = function (name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        } else {
            var expires = "";
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    };

    /**
     * 获取cookie
     * @param name
     * @returns {*}
     */
    Cookie.prototype.getCookie = function (name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    };

    /**
     * 删除cookie
     * @param name
     */
    Cookie.prototype.deleteCookie = function (name) {
        setCookie(name, "", -1);
    };

    return Cookie;
});