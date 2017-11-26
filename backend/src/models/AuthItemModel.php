<?php
namespace backend\src\models;

use yii\db\ActiveRecord;

/**
 * User model
 */
class AuthItemModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }
}
