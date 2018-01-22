<?php
namespace console\controllers\Cs;

use common\components\Enum\ErrorCode;
use console\controllers\dope\idClient;
use yii\console\Controller;

class IdController extends Controller
{
    public function actionIndex()
    {
        $id = idClient::getInstance()->id(1, 1, intval(strtotime('2017-05-27')));
        dump(strlen($id));
    }
}