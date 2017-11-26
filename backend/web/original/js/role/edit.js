$(function () {
    var Popup = require('./../../component/popup'),
        service = require('../../service/role/roleService');
        temp = require('./../../component/temp');
    // 引入验证类
    require('../../lib/jquery-form-validator/jquery.form-validator.js');

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

    $.validate({
        form: '#form',
        validateOnBlur: false,
        onSuccess: function ($form) {
            moreValidate();
            return false;
        }
    });
    
    function moreValidate() {
        var opt = {data: {}};
        service.add({
            data: $('#form').serialize(),
            beforeSend: function () {
                $loadingPop.showPop(opt);
            },
            sucFn: function (data, status, xhr) {
                $loadingPop.closePop();
                $successPop.showPop(opt);
                setTimeout(skipUpdate, 2000);

                function skipUpdate() {
                    $successPop.closePop();
                    window.location.href = '/role/index';
                }
            },
            errFn: function (data, status, xhr) {
                $loadingPop.closePop();
                $('.text').html(showError(data));
                $promptPop.showPop(opt);
            }
        })
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

})