<?php

namespace frontend\controllers\api\user;


use Carbon\Carbon;
use common\src\app\support\repository\UserRepository;
use frontend\src\form\user\userForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;


class RegisterController extends Controller
{

    /**
     * 邮箱注册
     * @return array
     */
    public function actionRegister()
    {
        $data = [];
        Yii::$app->response->format = Response::FORMAT_JSON;

        $user_form = new userForm();
        $user_form->load(Yii::$app->request->get(), '');

        if ($user_form->validate()) {
            $user_entity = $user_form->user_entity;
            $user_repository = new UserRepository();
            $user_repository->save($user_entity);
        } else {
            Yii::$app->response->statusCode = 400;
            return $user_form->errors;
        }
        return $data;
    }

}