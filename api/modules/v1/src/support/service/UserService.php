<?php

namespace api\modules\v1\src\support\service;

use api\library\ErrorCode;
use api\modules\v1\src\support\repository\UserRepository;
use yii\helpers\ArrayHelper;
use yii\web\UnauthorizedHttpException;

class UserService
{
    /**
     * 验证token的时效性
     * @param mixed $token
     * @param null  $type
     * @return array|bool|mixed|null|ActiveRecord
     * @throws UnauthorizedHttpException
     */
    public static function findIdentityByAccessToken($token)
    {
        $user_repository = new UserRepository();
        $user_model = $user_repository->getToken($token);
        if (empty($token)) throw new UnauthorizedHttpException(null, ErrorCode::ERROR_TOKEN_ILLEGAL);
//        $updated_at = strtotime(ArrayHelper::getValue($user_model, 'updated_at'));
//        return $token;
    }
}