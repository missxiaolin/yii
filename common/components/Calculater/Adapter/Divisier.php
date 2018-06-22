<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/22
 * Time: 上午9:57
 */

namespace common\components\Calculater\Adapter;


use common\components\Calculater\Adapter;

class Divisier extends Adapter
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
                $result /= $value;
            }
        }
        return $result;
    }
}