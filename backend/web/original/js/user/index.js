$(function () {
    var Popup = require('./../../component/popup'),
        temp = require('./../../component/temp'),
        data_id;

    // 弹框模板
    $confirmPop = new Popup({
        width: 400,
        height: 225,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#confirmTpl').html()
    });

    // 删除点击
    $('.delete').on('click', function () {
        data_id = $(this).data('id');
        var opt = {data: {}};
        $confirmPop.showPop(opt);
        return false;
    });

    // 取消
    $(document).on('click', '#dialog_cancel', function () {
        $confirmPop.closePop();
    });

    // 确认
    $(document).on('click', '#dialog_confirm', function () {
        alert('点击了确认')
    });
});