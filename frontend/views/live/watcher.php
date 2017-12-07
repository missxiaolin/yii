<?php

?>

<video id="video" autoplay></video>

<script type="text/javascript">
    //使用Google的stun服务器
    var iceServer = {
        "iceServers": [{
            "url": "stun:stunserver.org"
        }]
    };
    //兼容浏览器的getUserMedia写法
    var getUserMedia = (navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);
    //兼容浏览器的PeerConnection写法
    var PeerConnection = (window.PeerConnection ||
    window.webkitPeerConnection00 ||
    window.webkitRTCPeerConnection ||
    window.mozRTCPeerConnection);
    //与后台服务器的WebSocket连接
    var socket = new WebSocket('ws://127.0.0.1:13001');
    //创建PeerConnection实例
    var pc = new PeerConnection(iceServer);

    var video = document.getElementById('video');

    //如果检测到媒体流连接到本地，将其绑定到一个video标签上输出
    pc.onaddstream = function (event) {
        video.src = URL.createObjectURL(event.stream);
    };

    //处理到来的信令
    socket.onmessage = function (event) {
        var json = JSON.parse(event.data);
        console.log(json);
        //如果是一个ICE的候选，则将其加入到PeerConnection中，否则设定对方的session描述为传递过来的描述
        pc.setRemoteDescription(new RTCSessionDescription(json.data.sdp));
    };
</script>
