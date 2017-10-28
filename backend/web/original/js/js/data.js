$(function () {

    require('../../lib/datetimepicker/jquery.datetimepicker.js');

    // $('#demo').datetimepicker({
    //     timepicker: false,
    //
    //     format: 'Y',
    //     formatDate: 'Y',
    //     closeOnDateSelect: true,
    //     scrollInput: false,
    //     lang: 'zh',
    //     // maxDate: myDate.toLocaleString()//当前日期
    // });

    // 日期选择
    $('.form-control1').datetimepicker({
        timepicker:false,
        formatDate:'Y-m-d',
        onChangeDateTime:function(dp,$input){
            console.log($input.val())
        }
    });

    // 日期与时间
    $('.form-control2').datetimepicker({
        format:'Y-m-d H:i:s',
        step:5,
        onChangeDateTime:function(dp,$input){
            console.log($input.val())
        }
    });

    // 时间区间
    $('.date_timepicker_start').datetimepicker({
        format:'Y/m/d',
        onShow:function( ct ){
            this.setOptions({
                maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
            })
        },
        timepicker:false
    });

    $('.date_timepicker_end').datetimepicker({
        format:'Y/m/d',
        onShow:function( ct ){
            this.setOptions({
                minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
            })
        },
        timepicker:false
    });

    // 时间选择
    $('.form-control3').datetimepicker({
        datepicker: false,
        format: 'h:i'
    });






});