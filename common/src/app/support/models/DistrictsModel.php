<?php
namespace common\src\app\support\models;

use yii\db\ActiveRecord;

/**
 * User model
 */
class DistrictsModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%poi_districts}}';
    }
}