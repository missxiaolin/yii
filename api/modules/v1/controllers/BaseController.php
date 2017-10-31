<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\helpers\ArrayHelper;
use api\modules\v1\controllers\QueryParamAuth\QueryParamAuth;
use yii\web\Response;


class BaseController extends Controller
{
    // 需要验证
    protected $actions = ['*'];
    // 那些方法过滤
    protected $except = [];

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => QueryParamAuth::className(),
                'only' => $this->actions,
                'optional' => $this->except
            ],
        ]);
    }

    /**
     * get post 参数
     */
    public function init()
    {
        parent::init();
        if (Yii::$app->request->isGet) $this->request = Yii::$app->request->get();
        if (Yii::$app->request->isPost) $this->request = Yii::$app->request->bodyParams;
    }

    /**
     * @param $data
     * @param string $code
     * @param string $msg
     * @return array
     */
    public function apiResponse($data, $code = '0', $msg = 'ok')
    {
//        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        $json = [
            'data' => $data,
            'code' => $code,
            'msg' => $msg,
            'time' => (string)time(),
            '_ut' => (string)round(microtime(TRUE) - $_SERVER['REQUEST_TIME_FLOAT'], 5),
        ];
        return $json;
    }

}
