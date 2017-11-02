<?php

namespace assets\src\service;

use assets\src\form\userForm;
use assets\src\repository\UserRepository;
use yii\web\Response;
use Yii;

class UserService
{
    /**
     * 用户注册
     * @param $param
     * @return array
     */
    public function setRegister($param)
    {
        $user_form = new userForm();
        $user_form->load($param, '');
        if ($user_form->validate()) {
            $user_entity = $user_form->user_entity;
            $user_repository = new UserRepository();
            $user_repository->save($user_entity);
        } else {
            return api_response([], 20001, $user_form->getValidators()[0]->message);
        }
        return api_response($user_entity);
    }

    /**
     * 通过email获取用户
     * @param $email
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getEmail($email)
    {
        $user_repository = new UserRepository();
        $user_model = $user_repository->getEmail($email);
        return $user_model;
    }
}