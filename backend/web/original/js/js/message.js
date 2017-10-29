$(function () {
    var message = require('../../component/message');

    $('.btn').click(function () {
        message('基本使用','','warning')
    })
    // 基本使用
    // message('弹出框宽度100%', '', 'success', 2, {width: '80%'});

    // message('使用modal模态框事件处理', '', 'success', 2, {
    //     events: {
    //         'hidden.bs.modal': function () {
    //             alert('模态框消失时');
    //         }
    //     }
    // });
})