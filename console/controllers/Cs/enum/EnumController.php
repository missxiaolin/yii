<?php
namespace console\controllers\Cs\enum;

use common\components\Enum\ErrorCode;
use common\src\foundation\domain\exceptions\Exception;
use yii\console\Controller;
use Yii;

class EnumController extends Controller
{

    /**
     * ReflectionClass类测试
     * @param int $code
     */
    public function actionTest($code = 400)
    {
        $enum = '';
        $message = '';
        try {
            $class = new \ReflectionClass(Person::class);//建立 Person这个类的反射类
//            $instances = $class->newInstanceArgs();//相当于实例化Person 类
//            foreach ($instances as $key => $value) {
//                if ($value == $code) {
//                    $enum = $key;
//                }
//            }
//            if (!$enum){
//                throw new Exception('未找到对应属性');
//            }

            $properties = $class->getProperties();
            foreach ($properties as $item){
                if ($item->getValue() == $code){
                    $message = $item->getDocComment();
                }
            }
            $info = DocParserFactory::getInstance()->parse($message);
            dd($info);
//            $arr = explode("\n",$message);
//            foreach ($arr as $value){
//                dump($value);
//                dump(strpos("系统错误",$value));
//            }


        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * 测试
     */
    public function actionEnum()
    {
        dd(ErrorCode::getMessage(700));
    }
}
