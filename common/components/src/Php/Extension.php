<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 下午1:34
 */

namespace common\components\src\Php;

use common\components\Common\InstanceTrait;

class Extension
{
    use InstanceTrait;

    public $extensions = [];

    public function __construct()
    {
        $this->extensions = get_loaded_extensions();
    }
}