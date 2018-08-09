<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/9
 * Time: 下午2:51
 */

namespace console\controllers\pattern\abs;

use yii\console\Controller;
use Yii;

class AbsController extends Controller
{
    public function actionTest()
    {
        $factory = new JsonFactory();
        $text = $factory->createText('foobar');
        $text->setData(1);
        dd($text);
    }
}