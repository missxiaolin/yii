$(function () {
    var modal = require('../../component/modal.js');

    $('.btn').click(function () {
        modal({
            title: 'hellow',//标题
            content: 'content',//内容
            footer: '<button type="button" class="btn btn-default confirm" data-dismiss="modal">关闭</button>',//底部
            width: 600,//宽度
            events: {
                confirm: function () {
                    //哪个元素上有.confirm类，被点击就执行这个回调
                    alert('点击了关闭按钮');
                }
            }
        });
    });

});