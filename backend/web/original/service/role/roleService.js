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
    // 分配权限
    var _power = function add(opts) {
        $.http({
            type: 'POST',
            url: '/api/role/rbac/power',
            data: opts.data,
            dataType: 'json',
            beforeSend: opts.beforeSend,
            success: opts.sucFn,
            error: opts.errFn
        });
    };


    return {
        add: _add,
        power: _power
    };

})();