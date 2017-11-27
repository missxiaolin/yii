<?php
namespace backend\src\models;

use yii\db\ActiveRecord;

/**
 * User model
 */
class AuthItemChildModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item_child}}';
    }
}
