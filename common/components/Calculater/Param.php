<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/21
 * Time: 下午6:16
 */

namespace common\components\Calculater;

use Exception;


class Param
{
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $string
     * @return mixed
     * @throws Exception
     */
    public function getValue($string)
    {
        if (is_numeric($string)) {
            return $string;
        }

        preg_match('/^\((\d+)\)$/', $string, $result);
        if (!isset($result[1]) || !is_numeric($result[1])) {
            throw new Exception('参数格式不合法');
        }

        if (!isset($this->params[$result[1]])) {
            throw new Exception("目标参数[$result[1]]不存在！");
        }

        return $this->params[$result[1]];
    }

    /**
     * @param $begin
     * @param $end
     * @return array
     * @throws Exception
     */
    public function getRangeValue($begin, $end)
    {
        $result = [];
        while ($begin <= $end) {
            if (!isset($this->params[$begin])) {
                throw new Exception("目标参数[$begin]不存在！");
            }
            $result[$begin] = $this->params[$begin];
            $begin++;
        }

        return $result;
    }
}