<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午3:20
 */

namespace console\controllers\pattern\mapper;


use yii\console\Controller;

class CsController extends Controller
{
    public function actionTest1()
    {
        $storage = new StorageAdapter([1 => ['username' => 'xiaolin', 'email' => '462441355@qq.com']]);
        $mapper = new UserMapper($storage);

        $user = $mapper->findById(1);
        dump($user);
    }

    public function actionTest2()
    {
        $storage = new StorageAdapter([1 => ['username' => 'xiaolin', 'email' => '462441355@qq.com']]);
        $mapper = new UserMapper($storage);

        $user = $mapper->findById(1);
        dump($user);
    }
}