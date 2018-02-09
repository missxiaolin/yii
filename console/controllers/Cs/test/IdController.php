<?php
namespace console\controllers\Cs\test;

use yii\console\Controller;
use Yii;

class IdController extends Controller
{
    /**
     * 根据订单ID或者用户ID获取数据库名
     * @param null $id
     * @param null $userId
     */
    public function actionId($id = null, $userId = null)
    {
        if (isset($id)) {
            $num = str_pad(decbin($id), 64, '0', STR_PAD_LEFT);
            $bit = substr($num, 42, 10); // userId 的10个bit位
            $bit = substr($bit, -3, 3);
            dump(bindec($bit));
        }

        $bit = decbin($userId);
        $bit = substr($bit, -3, 3);
        dump(bindec($bit));
    }
}