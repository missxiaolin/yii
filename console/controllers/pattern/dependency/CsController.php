<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午3:47
 */

namespace console\controllers\pattern\dependency;


use yii\console\Controller;

class CsController extends Controller
{
    public function actionTest()
    {
        $config = new DatabaseConfiguration('localhost', 3306, 'domnikl', '1234');
        $connection = new DatabaseConnection($config);
        // 'domnikl:1234@localhost:3306'
        dump($connection->getDsn());
    }
}