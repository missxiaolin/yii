<?php
namespace api\modules\v1\src\support\Model;

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
