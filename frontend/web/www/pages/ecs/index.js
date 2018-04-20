require(['jquery', 'zeropadding'], function ($) {

    var IV = '1234567890123412';

    var KEY = 'd48d03c3322006ec772a7eefd8532c88';

    /**
     * 加密
     */
    function encrypt(str) {
        var key = CryptoJS.enc.Utf8.parse(KEY);// 秘钥
        var iv = CryptoJS.enc.Utf8.parse(IV);//向量iv
        var encrypted = CryptoJS.AES.encrypt(str, key, {
            iv: iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.ZeroPadding
        });
        return encrypted.toString(); //返回的是base64格式的密文
    }

    /**
     * 解密
     * @param str
     */
    function decrypt(str) {
        var key = CryptoJS.enc.Utf8.parse(KEY);// 秘钥
        var iv = CryptoJS.enc.Utf8.parse(IV);//向量iv
        var decrypted = CryptoJS.AES.decrypt(str, key, {iv: iv, padding: CryptoJS.pad.ZeroPadding});
        return decrypted.toString(CryptoJS.enc.Utf8);
    }

    var encrypt = encrypt('17135501105');

    console.log(encrypt);

    console.log(decrypt(encrypt))
});