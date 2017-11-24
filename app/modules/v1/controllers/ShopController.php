<?php
namespace app\modules\v1\controllers;

use common\src\app\support\models\ShopsModel;
use common\src\app\support\service\ShopsService;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class ShopController extends BaseController
{
    /**
     * vue（测试用）
     * @return array
     */
    public function actionList()
    {
        $params = $this->request;
        $shop_service = new ShopsService();
        $data = $shop_service->getList($params);
        return api_response($data);
    }
}