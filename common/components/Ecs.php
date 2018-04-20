<?php

namespace common\components;

use Yii;

class Ecs
{
    /**向量
     * @var string
     */
    const IV = "1234567890123412";// 16位
    /**
     * 默认秘钥
     */
    const KEY = 'd48d03c3322006ec772a7eefd8532c88';// 32位

    /**
     * 解密字符串
     * @param string $data 字符串
     * @param string $key 加密key
     * @return string
     */
    public static function decryptWithOpenssl($data, $key = self::KEY, $iv = self::IV)
    {
        return openssl_decrypt(base64_decode($data), "aes-256-cbc", $key, OPENSSL_RAW_DATA, $iv);
    }

    /**
     * 加密字符串
     * @param string $data 字符串
     * @param string $key 加密key
     * @return string
     */
    public static function encryptWithOpenssl($data, $key = self::KEY, $iv = self::IV)
    {
        return base64_encode(openssl_encrypt($data, "aes-256-cbc", $key, OPENSSL_RAW_DATA, $iv));
    }
}