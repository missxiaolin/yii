<?php
namespace console\controllers\districts;

use common\src\app\support\service\DistrictService;
use yii\console\Controller;
use Yii;

class CsController extends Controller
{
    public function actionTest()
    {
        DistrictService::getInstance()->crawl();
    }
}