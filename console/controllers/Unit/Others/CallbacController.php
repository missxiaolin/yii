<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/19
 * Time: 上午10:32
 */

namespace console\controllers\Unit\Others;

use common\components\CallNext;
use yii\console\Controller;
use Yii;

class CallbacController extends Controller
{
    public function actionIndex()
    {
        $callback = function ($request) {
            return $request['count'];
        };

        for ($i = 0; $i < 10; $i++) {
            $cls = new CallNext();
            $callback = function ($request) use ($cls, $callback) {
                return $cls->handle($request, $callback);
            };
        }

        $request = ['count' => 0];
        $res = $callback($request);

        dump(10 . $res);
    }
}