<?php

namespace common\src\app\support\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 * User model
 */
class ShopsModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shops}}';
    }
}
