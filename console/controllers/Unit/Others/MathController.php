<?php

namespace console\controllers\Unit\Others;

use yii\console\Controller;
use Yii;

class MathController extends Controller
{
    /**
     * 绝对值
     */
    public function actionAbs()
    {
        dump("绝对值abs");
        dump("原值：" . 4.2);
        dump("abs:" . abs(-4.2));
    }

    /**
     * @desc   进一法取整
     */
    public function actionCeil()
    {
        dump("进一法取整ceil");
        dump("原值：" . 9);
        dump("ceil:" . ceil(8.9));
    }

    /**
     * @desc   舍去法取整
     */
    public function actionFloor()
    {
        dump("舍去法取整floor");
        dump("原值：" . 8);
        dump("floor:" . floor(8.9));
    }

    /**
     * @desc   n次方
     */
    public function actionPow()
    {
        dump("n次方pow");
        dump("原值：" . 8);
        dump("pow:" . pow(2,3));
    }

    /**
     * @desc   四舍五入
     */
    public function actionRound()
    {
        dump("四舍五入round");
        dump("原值：" . 9);
        dump("pow:" . round(8.9));
    }

    /**
     * @desc   平方根
     */
    public function actionSqrt()
    {
        dump("平方根sqrt");
        dump("原值：" . 3);
        dump("sqrt:" . sqrt(9));
    }
}