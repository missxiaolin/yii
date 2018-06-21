<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/21
 * Time: 下午6:12
 */

namespace common\components\Calculater\Adapter;

use common\components\Calculater\Adapter;

class Adder  extends Adapter
{
    /**
     * @return int|mixed
     */
    public function handle()
    {
        $result = 0;
        foreach ($this->arguments as $arg) {
            $result += $this->getValue($arg);
        }
        return $result;
    }
}