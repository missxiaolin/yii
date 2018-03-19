<?php
namespace console\controllers\districts;

use common\src\app\support\service\DistrictService;
use yii\console\Controller;
use Yii;

class CsController extends Controller
{
    public function actionTest($id = 0)
    {
        while (true) {
            $id = DistrictService::getInstance()->crawl($id);
            if ($id == 0) {
                break;
            }
            dump('当前处理到 ID=' . $id);

        }
    }
}