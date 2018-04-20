<?php

namespace console\controllers\Unit\Others;

use common\components\EcsJs;
use yii\console\Controller;
use Yii;

class EcsController extends Controller
{
    public function actionTest()
    {
        $mobile = '17135501105';
        dump('原始字符串:' . $mobile);
        $encode = EcsJs::encryptWithOpenssl($mobile);
        dump("加密后：" . $encode);
        dump("mcrypt加密后" . EcsJs::mcrypt($mobile));
        $decode = EcsJs::decryptWithOpenssl($encode);
        dump('解密后：' . $decode);
    }
}