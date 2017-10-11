require(['jquery'], function ($) {
    var receiver_socket = new WebSocket("ws://127.0.0.1:9501");
    var image = document.getElementById('receiver');
    receiver_socket.onmessage = function (data) {
        image.src = data.data;
    }
})