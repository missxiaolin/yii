<?php
namespace app\modules\v1\controllers;

use common\src\app\support\models\ShopsModel;
use Yii;

class ShopController extends BaseController
{
    /**
     * vue（测试用）
     * @return array
     */
    public function actionList()
    {
        $data = [];
        $shop_model = ShopsModel::find()->limit(10)->all();
        return api_response($shop_model);
    }
}