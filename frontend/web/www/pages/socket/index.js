require(['jquery'], function ($) {
    // 使用H5的WebSocket协议
    var socket = new WebSocket("ws://127.0.0.1:9501");
    // canvas 对象
    var back = document.getElementById('output');
    // 返回一个用于在画布上绘图的环境。
    var backcontext = back.getContext('2d');
    // 获得第一个 video 标签元素
    var video = document.getElementsByTagName('video')[0];

    var success = function (stream) {
        // 把二进制对象读成浏览器能够识别的对象(创建内存地址)
        video.src = window.URL.createObjectURL(stream);
    }

    // 连接成功建立的回调方法
    socket.onopen = function () {
        draw();
    }

    // 开始发送图片画面
    var draw = function () {
        try {
            backcontext.drawImage(video, 0, 0, back.width, back.height);
        } catch (e) {
            if (e.name == "NS_ERROR_NOT_AVAILABLE") {
                return setTimeout(draw, 100);
            } else {
                throw e;
                go
            }
        }
        if (video.src) {
            // toDataURL(图片格式,图片质量0-1)
            socket.send(back.toDataURL("image/jpeg", 1));
        }
        setTimeout(draw, 100);
    }


    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia || navigator.msGetUserMedia;
    navigator.getUserMedia({video: true, audio: false}, success, console.log);
})