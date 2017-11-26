module.exports = (function () {
    // 添加角色
    var _add = function add(opts) {
        $.http({
            type: 'POST',
            url: '/api/role/rbac/add',
            data: opts.data,
            dataType: 'json',
            beforeSend: opts.beforeSend,
            success: opts.sucFn,
            error: opts.errFn
        });
    };


    return {
        add: _add
    };

})();