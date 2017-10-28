$(function () {

    require('../../lib/datetimepicker/jquery.datetimepicker.js');

    $('.demo').datetimepicker({
        timepicker: false,

        format: 'Y',
        formatDate: 'Y',
        closeOnDateSelect: true,
        scrollInput: false,
        lang: 'zh',
        // maxDate: myDate.toLocaleString()//当前日期
    });

});