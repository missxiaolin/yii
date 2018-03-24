<?php
namespace console\controllers\Cs\enum;


class Person
{
    /**
     * @Message('系统错误')
     */
    public static $ENUM_SYSTEM_ERROR = 400;

    /**
     * @Message('CURL接口访问失败')
     */
    protected static $ENUM_SYSTEM_CURL_ERROR = 401;

    /**
     * @Message('API 配置不存在')
     */
    private static $ENUM_SYSTEM_API_CONFIG_NOT_EXIST = 402;

}