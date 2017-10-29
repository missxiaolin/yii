module.exports = (function () {
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

})();