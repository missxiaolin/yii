module.exports = (function ($) {
    function Area(options) {
        var defOpts = {
            idNames: [],
            data: []
        };
        this.opts = $.extend(defOpts, options);
        this.init();
    }

    //执行
    Area.prototype.init = function () {
        var self = this;
        //防止多次调用多次循环
        if (typeof firstOption == 'undefined') {
            firstOption = '<option value="">--请选择--</option>';
            //找到所有的一级地区
            firstOption += self.getOption(this.opts.data);
        }
        $.each(this.opts.idNames, function (k, idNewName) {
            if (k == 0) {
                $('#' + idNewName).html(firstOption);
            } else {
                $('#' + idNewName).html('<option value="">--请选择--</option>');
            }
            //所有的select选中事件
            $('#' + idNewName).change(function () {
                //触发当前的change事件
                self.change($(this).find('option:selected').val(), $(this));
            })
        });
    };

    //切换地区时的动作
    Area.prototype.change = function (areaId, thisObj) {
        var self = this;
        //获得选中第几个select
        var idName = thisObj.attr('id');
        var num = 0;
        $.each(this.opts.idNames, function (k, idNewName) {
            if (idName == idNewName) {
                num = k;
            }
        });
        var option;
        if (num == 0) { //表示选择的是第一级
            option = '<option value="">--请选择--</option>';
            $.each(self.opts.data, function (k, v) {
                if (v.id == areaId) {
                    option += self.getOption(v.nodes);
                }
            });
            $('#' + self.opts.idNames[num + 1]).html(option);
        } else if (num == 1) {//选择的是第二级，对第三级处理

        }
    };

    //修改的时候 选中的方法
    Area.prototype.selectedId = function (first, second, third) {
        var self = this;
        $('#' + self.opts.idNames[0]).find('option[value=' + first + ']').attr('selected', true);
        self.change($('#' + self.opts.idNames[0]).find('option:selected').val(), $('#' + self.opts.idNames[0]));

        $('#' + self.opts.idNames[1]).find('option[value=' + second + ']').attr('selected', true);

    };

    //获得option
    Area.prototype.getOption = function (data) {
        var option = '';
        var _this = this;
        $.each(data, function (k, v) {
            option += '<option value="' + v.id + '">' + v.name + '</option>';
        });
        return option;
    };
    return Area;
})(jQuery);