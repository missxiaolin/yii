<?php
namespace console\controllers\Cs;

use common\components\Enum\ErrorCode;
use yii\console\Controller;

class ErrorController extends Controller
{
    public function actionIndex()
    {
        dump(ErrorCode::getMessage(ErrorCode::$ENUM_INVALID_TOKEN));
    }
}