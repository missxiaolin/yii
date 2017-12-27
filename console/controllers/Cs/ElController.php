<?php
namespace console\controllers\Cs;

use common\src\app\support\models\ShopsModel;
use common\src\app\support\models\ShopsElModel;
use yii\console\Controller;
use Exception;
use Yii;

class ElController extends Controller
{
    /**
     * @param $id
     */
    public function actionIndex($id)
    {
        try {
            $shop_model = ShopsModel::find()->where(['shop_id' => $id])->one();
            $el_shop_model = new ShopsElModel();$el_shop_model->primaryKey = $shop_model->shop_id;
            $el_shop_model->shop_name = $shop_model->shop_name;
            $el_shop_model->longitude = $shop_model->longitude;
            $el_shop_model->latitude = $shop_model->latitude;
            $el_shop_model->save();
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }

    /**
     * @param $keyword
     */
    public function actionGetShop($keyword)
    {
        try {
            $el_shop_models = ShopsElModel::find()
                ->query([
                    'bool' => [
                        'must' => [
                            ['match' => ['shop_name' => $keyword]],
                        ],
                    ],
                ])
                ->highlight([
                    'pre_tags' => ['<em>'],
                    'post_tags' => ['</em>'],
                    'fields' => [
                        'shop_name' => new \stdClass(),
                    ],
                ])
                ->all();
            dump($el_shop_models);
        } catch (Exception $e) {
            dump($e->getMessage());
        }

    }

    public function actionList()
    {
        try{

        }catch (\Exception $e){

        }
    }
}