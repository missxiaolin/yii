$(function () {
    $.validate({
        form: '#form',
        onSuccess: function ($form) {
            return true;
        }
    });
});