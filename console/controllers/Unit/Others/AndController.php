<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/20
 * Time: 下午8:02
 */

namespace console\controllers\Unit\Others;

use yii\console\Controller;
use Yii;

class AndController extends Controller
{
    public function actionAnd()
    {
        $a = bindec('1111');
        $b = bindec('0101');

        $c = $a & $b;
        dump(101);
        dump(decbin($c));
    }

    public function actionOr()
    {
        $a = bindec('1111');
        $b = bindec('0101');

        $c = $a | $b;
        dump('1111');
        dump(decbin($c));
    }

    public function actionBit()
    {
        $dog = bindec('1');
        $cat = bindec('10');
        $bird = bindec('100');

        // 有猫有鸟
        dump(110);
        dump(decbin($cat | $bird));

        // 全都有
        $all = $dog | $cat | $bird;
        dump(111);
        dump(decbin($all));

        // 去掉狗
        dump(110);
        dump(decbin($all & ~$dog));
    }

}