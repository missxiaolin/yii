<?php
namespace common\components\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('系统错误')
     */
    public static $ENUM_SYSTEM_ERROR = 400;

    /**
     * @Message('非法的TOKEN')
     * @Desc('需要重新登录')
     */
    public static $ENUM_INVALID_TOKEN = 700;

    /**
     * @Message('Calculater 未定义')
     */
    public static $ENUM_CALCULATER_NOT_DEFINED = 2001;

    /**
     * @Message('Calculater 表达式不合法')
     */
    public static $ENUM_CALCULATER_STRING_INVALID = 2002;
}