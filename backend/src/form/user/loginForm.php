<?php

namespace backend\src\form\user;

use backend\src\service\AdminService;
use yii\base\Model;
use Yii;

class loginForm extends Model
{

    public $username = '';
    public $password = '';
    public $rememberMe = false;

    private $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => '请输入账号'],
            ['password', 'required', 'message' => '请输入密码'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'verifyAccount'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'account' => '账户',
            'password' => '密码',
        ];
    }

    /**
     * 验证账户是否符合规则
     * @param $attribute
     * @param $params
     * @return bool
     */
    public function verifyAccount($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $admin_service = new AdminService();
            $admin_model = $admin_service->getUser($this->username);
            if (empty($admin_model) || !$admin_service->validatePassword($admin_model->password, $admin_model->auth_key, $this->password)) {
                $this->addError('error', '账号和密码不匹配');
                return false;
            }
            $this->user = $admin_model;
        }
        return true;
    }

    /**
     * 验证
     * @param null $attributeNames
     * @param bool $clearErrors
     * @return bool
     */
    public function validate($attributeNames = null, $clearErrors = true)
    {
        if (parent::validate($attributeNames, $clearErrors)) {
            Yii::$app->user->login($this->user);
            return true;
        }
        return false;
    }

}