<?php

namespace common\components;

use common\components\Common\InstanceTrait;

class Alias
{
    use InstanceTrait;

    public function say()
    {
        return 'hello world';
    }
}
