<?php

namespace console\controllers\Unit\Others;

use yii\console\Controller;
use Yii;

class HashController extends Controller
{
    protected $password = '123456';

    public function actionPassword()
    {
        $pwd1 = password_hash($this->password, PASSWORD_BCRYPT);
        $pwd2 = password_hash($this->password, PASSWORD_BCRYPT);
        dump($pwd1);
        dump($pwd2);
        dump(password_verify($this->password, $pwd1));
        dump(password_verify($this->password, $pwd2));

        $pwd3 = password_hash($this->password, PASSWORD_DEFAULT);
        dump(password_verify($this->password, $pwd3));
    }

    public function actionTest()
    {
        $pwd1 = hash("sha256", $this->password);
        $pwd2 = hash("sha256", $this->password);
        dump($pwd1 == $pwd2);

        $pwd3 = hash('md5', $this->password);
        $pwd4 = md5($this->password);
        dump($pwd3 == $pwd4);
    }
}