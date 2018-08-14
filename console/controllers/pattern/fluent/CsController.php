<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午4:21
 */

namespace console\controllers\pattern\fluent;


use yii\console\Controller;

class CsController extends Controller
{
    public function actionTest()
    {
        $query = (new Sql())
            ->select(['foo', 'bar'])
            ->from('foobar', 'f')
            ->where('f.bar = ?');

        // SELECT foo, bar FROM foobar AS f WHERE f.bar = ?
        dump((string)$query);
    }
}