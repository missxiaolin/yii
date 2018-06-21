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
    /**
     * @throws \common\components\Calculater\Exceptions\CalculaterException
     */
    public function actionIndex()
    {
        $params = [
            1 => 1,
            2 => 3,
            10 => 22,
            11 => 123,
        ];

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
}