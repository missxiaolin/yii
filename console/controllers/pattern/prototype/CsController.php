<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 上午11:16
 */

namespace console\controllers\pattern\prototype;

use yii\console\Controller;
use Yii;

class CsController extends Controller
{
    public function actionTest()
    {
        $barPrototype = new BarBookPrototype();


        for ($i = 0; $i < 2; $i++) {
            $book = clone $barPrototype;
            $book->setTitle('Bar Book No ' . $i);
            dump($book);
        }
    }
}