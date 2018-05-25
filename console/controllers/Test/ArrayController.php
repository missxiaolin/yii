<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/25
 * Time: 下午8:30
 */

namespace console\controllers\Test;

use yii\console\Controller;

class ArrayController extends Controller
{
    public function actionQuote()
    {
        $items = ['a', 'b', 'c'];
        foreach ($items as &$item) {
        }
        foreach ($items as $item) {
        }
        dump($items);
    }

}