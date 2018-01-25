<?php
namespace common\src\app\support\models;

use yii\mongodb\ActiveRecord;

class MessageMongo extends ActiveRecord
{
    /**
     * @return array
     */
    public function attributes()
    {
        return [
            '_id',
            'name',
            'user_id',
            'type',
            'title',
            'content',
            'time'];
    }
}