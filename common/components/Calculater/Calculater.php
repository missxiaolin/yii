<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/17
 * Time: 上午9:31
 */

namespace common\components\Calculater;


use common\components\Calculater\Adapter\Adder;
use common\components\Calculater\Exceptions\CalculaterException;
use common\components\Common\InstanceTrait;
use common\components\Enum\ErrorCode;
use common\src\foundation\domain\exceptions\Exception;

class Calculater
{
    use InstanceTrait;

    public $adapter = [
        '+' => Adder::class,
    ];

    /**
     * @param $string
     * @param array $params
     * @return mixed
     * @throws CalculaterException
     */
    public function calculate($string, $params = [])
    {
        list($cal, $string) = explode(' ', $string, 2);

        if (!isset($this->adapter[$cal])) {
            throw new CalculaterException('Calcaulater Adapter is not defined.');
        }

        $string = trim($string);

        $pre_arguments = [];
        $param = '';
        $depth = 0;
        for ($i = 0; $i < strlen($string); $i++) {
            $char = $string[$i];
            if ($char === '(') {
                $depth++;
            } elseif ($char === ')') {
                $depth--;
            }
            $param .= $char;

            if ($depth === 0) {
                if (!empty(trim($param))) {
                    $pre_arguments[] = $param;
                }
                $param = '';
            }
        }

        $arguments = [];
        foreach ($pre_arguments as $argument) {
            if (is_numeric($argument)) {
                $arguments[] = $argument;
            } else {
                preg_match('/^\((.*)\)$/', $argument, $result);
                if (!isset($result[1])) {
                    throw new Exception('参数格式不合法');
                }

                if (is_numeric($result[1])) {
                    $arguments[] = $argument;
                } else {
                    $arguments[] = $this->calculate($result[1], $params);
                }
            }
        }

        $adapter = new $this->adapter[$cal]($arguments, $params);
        return $adapter->handle();
    }

}