<?php
namespace common\components\Filter;

use common\components\Library\ErrorCode;
use yii\web\UnauthorizedHttpException;
use yii\base\ActionFilter;
use yii\web\Response;
use Yii;

/**
 * 过滤器
 * Class AppAuth
 * @package common\components\Filter
 */
class AppAuth extends ActionFilter
{
    /**
     * @var Response the response to be sent. If not set, the `response` application component will be used.
     */
    public $response;

    /**
     * 业务逻辑
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        $response = $this->response ?: Yii::$app->getResponse();
        $this->handleFailure($response);
        return false;
    }


    /**
     * 错误抛出
     * @param $response
     * @throws UnauthorizedHttpException
     */
    public function handleFailure($response)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        throw new UnauthorizedHttpException(ErrorCode::getErrorCode(ErrorCode::ERROR_TOKEN_ILLEGAL), ErrorCode::ERROR_TOKEN_ILLEGAL);
    }
}