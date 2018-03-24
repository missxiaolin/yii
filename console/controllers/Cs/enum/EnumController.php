<?php
namespace console\controllers\Cs\enum;

use yii\console\Controller;
use Yii;

class EnumController extends Controller
{
    /**
     * ReflectionClass类测试
     */
    public function actionTest()
    {
        try {
            $class = new \ReflectionClass(Person::class);//建立 Person这个类的反射类
            $instance  = $class->newInstanceArgs();//相当于实例化Person 类
            dump($instance);
//            $properties = $class->getProperties();
//            dd($properties);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
