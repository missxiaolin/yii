<?php

namespace common\src\app\domain\support\models;

use yii\db\ActiveRecord;

/**
 * User model
 */
class UserModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }
}
