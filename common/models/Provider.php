<?php
namespace common\models;


class Provider extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fq_provider}}';
    }
}
