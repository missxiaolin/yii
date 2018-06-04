<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 上午10:12
 */

namespace console\controllers\Test;

use common\components\src\Os;
use yii\console\Controller;
use Yii;

class OsController extends Controller
{
    public function actionTest()
    {
        $os = Os::getInstance();
        dd(Os\Darwin::getInstance()->svr_darwin());
    }
}