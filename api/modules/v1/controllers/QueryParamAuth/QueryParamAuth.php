<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace api\modules\v1\controllers\QueryParamAuth;

use api\library\ErrorCode;
use yii\filters\auth\AuthMethod;
use yii\web\UnauthorizedHttpException;

/**
 * token验证
 * Class QueryParamAuth
 * @package api\modules\v1\controllers\QueryParamAuth
 */
class QueryParamAuth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    public $tokenParam = 'access-token';


    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->get($this->tokenParam);
        if (is_string($accessToken)) {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }
        if ($accessToken !== null) {
            $this->handleFailure($response);
        }
        return null;
    }

    public function handleFailure($response)
    {
        throw new UnauthorizedHttpException(ErrorCode::getErrorCode(ErrorCode::ERROR_TOKEN_ILLEGAL), ErrorCode::ERROR_TOKEN_ILLEGAL);
    }


}
