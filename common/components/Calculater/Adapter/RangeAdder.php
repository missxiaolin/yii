<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/22
 * Time: 上午9:57
 */

namespace common\components\Calculater\Adapter;

use common\components\Calculater\Adapter;
use Exception;


class RangeAdder extends Adapter
{
    /**
     * @return float|int
     * @throws Exception
     */
    public function handle()
    {
        if (!isset($this->arguments[0]) || !isset($this->arguments[1])) {
            throw new Exception('RangeAdder 必须传入初始值和终止值');
        }

        if (!is_numeric($this->arguments[0]) || !is_numeric($this->arguments[1])) {
            throw new Exception('RangeAdder 初始值和终止值必须为纯数字');
        }

        $begin = intval($this->arguments[0]);
        $end = intval($this->arguments[1]);

        $result = array_sum($this->param->getRangeValue($begin, $end));
        return $result;
    }
}