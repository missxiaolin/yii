<?php

namespace console\controllers\Unit\Others;

use common\components\Alias;
use yii\console\Controller;
use Alias2;
use Yii;

class ClassController extends Controller
{
    public function actionTest()
    {
        class_alias(Alias::class, 'Alias2');
        $o1 = Alias::getInstance();
        $o2 = Alias2::getInstance();
        dump($o1->say());
        dump($o2->say());
    }

    public function actionClass()
    {
        dump(class_exists(Alias::class));
        class_alias(Alias::class,'Alias3');
        dump(class_exists('Alias3'));
    }
}