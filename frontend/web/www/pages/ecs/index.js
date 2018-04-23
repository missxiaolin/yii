require(['jquery', 'zeropadding'], function ($) {

    var IV = '1234567890123412';

    var KEY = '201707eggplant99';


    /**
     * 加密
     */
    function openssl_encrypt(str) {
        key = CryptoJS.enc.Utf8.parse(KEY);// 秘钥
        var iv= CryptoJS.enc.Utf8.parse(IV);//向量iv
        var encrypted = CryptoJS.AES.encrypt(str, key, { iv: iv, mode: CryptoJS.mode.CBC, padding: CryptoJS.pad.Pkcs7});
        return encrypted.toString();
    }
    /**
     * 解密
     * @param str
     */
    function openssl_decrypt(str) {
        var key = CryptoJS.enc.Utf8.parse(KEY);// 秘钥
        var iv=    CryptoJS.enc.Utf8.parse(IV);//向量iv
        var decrypted = CryptoJS.AES.decrypt(str,key,{iv:iv,padding:CryptoJS.pad.Pkcs7});
        return decrypted.toString(CryptoJS.enc.Utf8);
    }

    var b = openssl_encrypt('17135501105')
    console.log(b)





    // /**
    //  * 加密
    //  */
    // function mcrypt_encrypt(str) {
    //     var key = CryptoJS.enc.Utf8.parse(KEY);// 秘钥
    //     var iv = CryptoJS.enc.Utf8.parse(IV);//向量iv
    //     var encrypted = CryptoJS.AES.encrypt(str, key, {
    //         iv: iv,
    //         mode: CryptoJS.mode.CBC,
    //         padding: CryptoJS.pad.ZeroPadding
    //     });
    //     return encrypted.toString(); //返回的是base64格式的密文
    // }
    //
    // /**
    //  * 解密
    //  * @param str
    //  */
    // function mcrypt_decrypt(str) {
    //     var key = CryptoJS.enc.Utf8.parse(KEY);// 秘钥
    //     var iv = CryptoJS.enc.Utf8.parse(IV);//向量iv
    //     var decrypted = CryptoJS.AES.decrypt(str, key, {iv: iv, padding: CryptoJS.pad.ZeroPadding});
    //     return decrypted.toString(CryptoJS.enc.Utf8);
    // }

    // var a = mcrypt_encrypt('17135501105');
    //
    // console.log(a);
    //
    // console.log(mcrypt_decrypt(encrypt))
});