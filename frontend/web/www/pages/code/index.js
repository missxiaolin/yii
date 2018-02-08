require(['jquery', 'http://static.geetest.com/static/tools/gt.js'], function ($) {
    var handlerPopup = function (captchaObj) {
        // 成功的回调
        captchaObj.onSuccess(function () {
            var validate = captchaObj.getValidate();
            console.log(validate);
            $.ajax({
                url: "/api/code/verify", // 进行二次验证
                type: "post",
                dataType: "json",
                data: {
                    type: "pc",
                    username: $('#username1').val(),
                    password: $('#password1').val(),
                    geetest_challenge: validate.geetest_challenge,
                    geetest_validate: validate.geetest_validate,
                    geetest_seccode: validate.geetest_seccode
                },
                success: function (data) {
                    console.log(data);
                    if (data && (data.success === true)) {
                        $(document.body).html('<h1>登录成功</h1>');
                    } else {
                        $(document.body).html('<h1>登录失败</h1>');
                    }
                }
            });
        });
        $("#popup-submit").click(function () {
            captchaObj.show();
        });
        // 将验证码加到id为captcha的元素里
        captchaObj.appendTo("#popup-captcha");
        // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
    };
    // 验证开始需要向网站主后台获取id，challenge，success（是否启用failback）
    $.ajax({
        url: "/api/code/start?type=pc&t=" + (new Date()).getTime(), // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            console.log(data)
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: "popup", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerPopup);
        }
    });
})