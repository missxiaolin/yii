<?php

namespace common\components;

use Yii;

class EcsJs
{
    /**向量
     * @var string
     */
    const IV = "1234567890123412";// 16位
    /**
     * 默认秘钥
     */
    const KEY = '201707eggplant99';// 16位

    /**
     * 解密字符串
     * @param string $data 字符串
     * @param string $key 加密key
     * @return string
     */
    public static function decryptWithOpenssl($data, $key = self::KEY, $iv = self::IV)
    {
        return openssl_decrypt(base64_decode($data), "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv);
    }

    /**
     * 加密字符串
     * @param string $data 字符串
     * @param string $key 加密key
     * @return string
     */
    public static function encryptWithOpenssl($data, $key = self::KEY, $iv = self::IV)
    {
        return base64_encode(openssl_encrypt($data, "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv));
    }

    public static function mcrypt($data, $key = self::KEY, $iv = self::IV)
    {
        error_reporting(E_ALL & ~E_DEPRECATED);
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv));
    }
}