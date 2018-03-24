<?php
namespace console\controllers\Cs\enum;

use yii\console\Controller;
use Yii;

class EnumController extends Controller
{
    public function actionTest()
    {
        try {
            $class = new \ReflectionClass(Person::class);//建立 Person这个类的反射类
//            $instance  = $class->newInstanceArgs();//相当于实例化Person 类
            $properties = $class->getProperties();
            dd($properties);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}