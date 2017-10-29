$(function () {
    var message = require('../../component/message');

    var confirm = require('../../component/confirm');


    $('.btn').click(function () {
        // message('基本使用','','warning')
        confirm('确定删除吗?', function () {
            alert('点击确定后执行的回调函数');
        })
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