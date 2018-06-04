<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 上午10:14
 */

namespace common\components\src;

use common\components\Common\InstanceTrait;

class Os
{
    use InstanceTrait;

    public $os;

    public $version;

    public $name;

    public function __construct()
    {
        $this->os = PHP_OS;
        $this->version = php_uname('r');
        $this->name = php_uname('n');
    }
}