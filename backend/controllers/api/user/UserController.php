<?php
namespace backend\controllers\api\user;

use backend\src\form\user\loginForm;
use yii\web\Response;
use yii\web\Controller;
use Yii;

/**
 * Site controller
 */
class UserController extends Controller
{
    /**
     * 邮箱登录
     * @return array
     */
    public function actionLogin()
    {
        $data = [];
        Yii::$app->response->format = Response::FORMAT_JSON;
        $login_from = new loginForm();
        $login_from->load(Yii::$app->request->post(), '');
        if ($login_from->validate()){
            $data['code'] = 200;
            $data['msg'] = '登录成功';
        }else{
            Yii::$app->response->statusCode = 400;
            return $login_from->errors;
        }
        return $data;
    }

}
