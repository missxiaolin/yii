<?php

namespace assets\src\form;
use assets\src\entity\UserEntity;
use yii\base\Model;
use Yii;

class userForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $user_entity;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['email', 'required'],
            ['email', 'unique', 'targetClass' => '\common\src\app\support\models\UserModel', 'message' => '该邮箱已经被注册。'],
            ['password', 'required'],
            ['password', 'match', 'pattern' => '/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/', 'message' => '密码由6-12位数字字母组成'],
            ['password', 'filter', 'filter' => 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'email' => '验证码',
            'password' => '密码',
        ];
    }


    /**
     * 验证
     * @param null $attributeNames
     * @param bool $clearErrors
     * @return bool
     */
    public function validate($attributeNames = null, $clearErrors = true)
    {
        $params = [];
        if (parent::validate($attributeNames, $clearErrors)) {
            $this->user_entity = new UserEntity();
            $params['email'] = '462441355@qq.com';
//            $this->user_entity->pendEvent(new Event(Email::class, $params));
            $this->user_entity->pendEvent(Yii::$app->event->registerEvent(Email::class,$params));
            $this->user_entity->username = $this->username;
            $this->user_entity->email = $this->email;
            // 生成随机盐
            $this->user_entity->auth_key = (String)rand(100000, 999999);
            $this->user_entity->password = md5(md5($this->password) . $this->user_entity->auth_key);
            return true;
        }
        return false;
    }


}