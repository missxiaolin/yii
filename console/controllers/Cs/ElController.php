<?php
namespace console\controllers\Cs;

use common\src\app\support\models\ShopsModel;
use common\src\app\support\models\ShopsElModel;
use yii\console\Controller;
use Exception;
use Yii;

class ElController extends Controller
{
    public function actionIndex()
    {
        try{
            $shop_model = ShopsModel::find()->where(['shop_id' => 263])->one();

            $el_shop_model = new ShopsElModel();
            $el_shop_model->primaryKey = $shop_model->shop_id;
            $el_shop_model->shop_name = $shop_model->shop_name;
            $el_shop_model->longitude = $shop_model->longitude;
            $el_shop_model->latitude = $shop_model->latitude;
            $el_shop_model->save();
        }catch (Exception $e){
            dump($e->getMessage());
        }
    }

    public function actionGetShop()
    {
        try{
//            $el_shop_models = ShopsElModel::find()->where(['shop_name'=>'周渝食惦'])->all();
//            $el_shop_models = ShopsElModel::find()->all();
            $el_shop_models = ShopsElModel::find()->where(['shop_nam'=>'周渝'])->search();
            dump($el_shop_models);
        }catch (Exception $e){
            dump($e->getMessage());
        }

    }
}