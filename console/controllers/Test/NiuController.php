<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/29
 * Time: 下午9:24
 */

namespace console\controllers\Test;

use common\components\Upload;
use yii\console\Controller;
use Yii;


class NiuController extends Controller
{
    public function actionIndex()
    {
        $img = Yii::$app->basePath . '/data/uploads/suqian1_20180529.jpg';
        Upload::getInstance()->image($img);
    }

}