<?php

namespace console\controllers\Unit\Others;

use common\components\Ecs;
use yii\console\Controller;
use Yii;

class EcsController extends Controller
{
    public function actionTest()
    {
        $mobile = '17135501105';
        dump('原始字符串:' . $mobile);
        $encode = Ecs::encryptWithOpenssl($mobile);
        dump("加密后：" . $encode);
        $decode = Ecs::decryptWithOpenssl($encode);
        dump('解密后：' . $decode);
    }
}