<?php
namespace api\modules\v1\controllers;


use api\modules\v1\controllers\QueryParamAuth\QueryParamAuth;
use yii\helpers\ArrayHelper;

class UserController extends BaseController
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => QueryParamAuth::className(),
                'optional' => [
                ]
            ],
        ]);
    }

    public function actionIndex()
    {
        $data = [];
        return $this->apiResponse($data);
    }
}