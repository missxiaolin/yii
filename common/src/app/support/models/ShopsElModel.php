<?php

namespace common\src\app\support\models;

use yii\elasticsearch\ActiveRecord;


/**
 * Shops model
 */
class ShopsElModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shops}}';
    }

    public function attributes() {
        return ['shop_id', 'shop_name','longitude','latitude'];
    }

}
