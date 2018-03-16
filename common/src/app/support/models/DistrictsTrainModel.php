<?php
namespace common\src\app\support\models;

use yii\db\ActiveRecord;

/**
 * User model
 */
class DistrictsTrainModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%district_train}}';
    }
}