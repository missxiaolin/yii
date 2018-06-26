<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/17
 * Time: 上午9:35
 */

namespace console\controllers\Unit\Others;

use common\components\Calculater\Calculater;
use yii\console\Controller;
use Yii;


class FunctionController extends Controller
{
    public $params = [
        1 => 1,
        2 => 3,
        10 => 22,
        11 => 123,
    ];

    /**
     * 加法
     * @throws \common\components\Calculater\Exceptions\CalculaterException
     */
    public function actionIndex()
    {
        $params = $this->params;

        $string = '+ (1) (+ (1) (2))';
        $result = Calculater::getInstance()->calculate($string, $params);
        dump(['原来' . 5, '转换后' . $result]);

        $string = '+ (1) (+ (1) 2)';
        $result = Calculater::getInstance()->calculate($string, $params);
        dump(['原来' . 4, '转换后' . $result]);

        $string = '+ (1) (+ 1 (11))';
        $result = Calculater::getInstance()->calculate($string, $params);
        dump(['原来' . 125, '转换后' . $result]);
    }

    /**
     * 减法
     * @throws \common\components\Calculater\Exceptions\CalculaterException
     */
    public function actionMinuse()
    {
        $string = '+ (1) (- (1) (2))';
        $result = Calculater::getInstance()->calculate($string, $this->params);
        dump(['原来' . -1, '转换后' . $result]);
    }

    /**
     * @throws \common\components\Calculater\Exceptions\CalculaterException
     */
    public function actionMultiplier()
    {
        $string = '+ (1) (* (1) (2))';
        $result = Calculater::getInstance()->calculate($string, $this->params);
        dump($result);
    }

    /**
     * @throws \common\components\Calculater\Exceptions\CalculaterException
     */
    public function actionRange()
    {
        $string = '+ (1) (++ 1 5)';
        $result = Calculater::getInstance()->calculate($string, $this->params);
        dump($result);
    }

    /**
     * @throws \common\components\Calculater\Exceptions\CalculaterException
     */
    public function actionDivisier()
    {
        $string = '+ (1) (/ (5) (2))';
        $result = Calculater::getInstance()->calculate($string, $this->params);
        dump($result);
    }

    /**
     * @throws \common\components\Calculater\Exceptions\CalculaterException
     */
    public function actionAverage()
    {
        $string = 'AVERAGE 1 5';
        $result = Calculater::getInstance()->calculate($string, $this->params);
        dump(25.4);
        dump($result);
    }
}