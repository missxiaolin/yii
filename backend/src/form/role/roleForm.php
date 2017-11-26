<?php

namespace backend\src\form\role;

use backend\src\entity\RoleEntity;
use yii\base\Model;
use Yii;

class roleForm extends Model
{

    public $name = '';
    public $description = '';

    public $role_contacts;

    private $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'filter', 'filter' => 'trim'],
            ['name', 'required', 'message' => '请输入标识'],
            ['description', 'required', 'message' => '请输入名称'],
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
            'description' => '名称',
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
            $role_entity = new RoleEntity();
            $role_entity->name = $this->name;
            $role_entity->description = $this->description;
            $this->role_contacts = $role_entity;
            return true;
        }
        return false;
    }

}