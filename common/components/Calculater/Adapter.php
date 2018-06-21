<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/21
 * Time: 下午6:13
 */

namespace common\components\Calculater;


abstract class Adapter implements CalculaterInterface
{
    protected $arguments;

    protected $param;

    /**
     * Adapter constructor.
     * @param $arguments 变量KEY或者数字
     * @param $params    变量值
     */
    public function __construct($arguments, $params)
    {
        $this->arguments = $arguments;
        $this->param = new Param($params);
    }

    /**
     * @param $string
     * @return mixed
     * @throws \Exception
     */
    public function getValue($string)
    {
        return $this->param->getValue($string);
    }
}