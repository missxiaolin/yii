<?php
namespace common\components\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('非法的TOKEN')
     * @Desc('需要重新登录')
     */
    public static $ENUM_INVALID_TOKEN = 700;
}