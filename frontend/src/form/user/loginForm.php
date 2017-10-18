<?php

namespace frontend\src\form\user;

use common\src\app\support\models\UserModel;
use common\src\app\support\service\UserService;
use yii\base\Model;
use Yii;

class loginForm extends Model
{

    public $email = '';
    public $password = '';
    public $rememberMe = false;

    private $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => '请输入账号'],
            ['password', 'required', 'message' => '请输入密码'],
            ['email', 'string', 'min' => 2, 'max' => 64],
            ['email', 'verifyAccount'],
            ['password', 'string', 'min' => 6, 'max' => 32],
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
            $user_service = new UserService();
            $user_model = $user_service->getEmail($this->email);
            if (empty($user_model) || !$user_service->validatePassword($user_model->password, $user_model->auth_key, $this->password)) {
                $this->addError('error', '账号和密码不匹配');
                return false;
            }
            $this->user = $user_model;
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