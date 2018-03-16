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

    /**
     * 查询子集
     * @return \yii\db\ActiveQuery
     */
    public function children()
    {
        return $this->hasMany(DistrictsModel::className(), ['parent_oid' => 'oid']);
    }
}