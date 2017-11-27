<?php

namespace backend\src\form\role;

use yii\base\Model;

class powerForm extends Model
{
    public $name;
    public $children;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required', 'message' => '名称必填'],
            ['children', 'required', 'message' => '请选择规则'],
            ['name', 'string', 'min' => 2, 'max' => 64],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => '标识',
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