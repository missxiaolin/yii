<?php

namespace backend\src\form\role;

use yii\base\Model;

class allotRoleForm extends Model
{
    public $id;
    public $children;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'filter', 'filter' => 'trim'],
            ['id', 'required', 'message' => 'id必填'],
            ['children', 'required', 'message' => '请选择规则'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => '标识',
            'children' => '规则',
        ];
    }

    /**
     * 验证
     * @param null $attributeNames
     * @param bool $clearErrors
     * @return bool
     */
    public function validate($attributeNames = null, $clearErrors = true)
    {
        if (parent::validate($attributeNames, $clearErrors)) {

            return true;
        }
        return false;
    }

}