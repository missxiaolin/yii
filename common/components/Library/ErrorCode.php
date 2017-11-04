<?php

namespace common\components\Library;


use yii\helpers\ArrayHelper;

class ErrorCode
{
    const ERROR_NO = 200;
    const ERROR_TOKEN_ILLEGAL = 1000;
    const ERROR_TOKEN_EXPIRE = 1001;
    const ERROR_MISS_PARAM = 1002;
    const ERROR_M_ILLEGAL = 1003;
    const ERROR_M_EXPIRE = 1004;

    /**
     * @param $code
     * @param null $message
     * @return mixed
     */
    public static function getErrorCode($code, $message = null)
    {
        $data = [
            self::ERROR_NO => 'success',
            self::ERROR_TOKEN_ILLEGAL => 'token非法',
            self::ERROR_TOKEN_EXPIRE => 'token过期',
            self::ERROR_MISS_PARAM => '缺少必填参数',
            self::ERROR_M_ILLEGAL => 'm值非法',
            self::ERROR_M_EXPIRE => 'm值过期',
        ];

        return ArrayHelper::getValue($data, $code);
    }

}
