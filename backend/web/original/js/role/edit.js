$(function () {
    var Popup = require('./../../component/popup'),
        temp = require('./../../component/temp');
    // 引入验证类
    require('../../lib/jquery-form-validator/jquery.form-validator.js');

    $.validate({
        form: '#form',
        validateOnBlur: false,
        onSuccess: function ($form) {
            return false;
        }
    });

})