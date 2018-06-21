<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/21
 * Time: 下午7:19
 */

namespace common\components\Calculater\Adapter;


use common\components\Calculater\Adapter;

class Minuser extends Adapter
{
    /**
     * @return int|mixed
     * @throws \Exception
     */
    public function handle()
    {
        $result = 0;
        $first = true;
        foreach ($this->arguments as $arg) {
            $value = $this->getValue($arg);
            if ($first) {
                $result = $value;
                $first = false;
            } else {
                $result -= $value;
            }
        }
        return $result;
    }
}