<?php
namespace api\modules\v1\controllers;

use Yii;

class UserController extends BaseController
{
    protected $except = ['index', 'register'];

    /**
     * 首页（测试用）
     * @return array
     */
    public function actionIndex()
    {
        $data = [];
        return $this->apiResponse($data);
    }

    public function actionRegister()
    {
        $data = Yii::$app->yar->api('user/register', 'setRegister', ['username' => 'xiaobei', 'email' => '228253848@qq.com', 'password' => 'lgb19941105']);
        if (empty($data)) {
            return api_response([], 20001, '系统异常');
        } else if ($data['code'] != 0) {
            return api_response([], 20001, $data['msg']);
        } else {
            return api_response($data['data']);
        }
    }
}