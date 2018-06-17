<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/17
 * Time: 上午9:31
 */

namespace common\components\Calculater;


use common\components\Common\InstanceTrait;
use common\components\Enum\ErrorCode;
use common\src\foundation\domain\exceptions\Exception;

class Calculater
{
    use InstanceTrait;

    public $calculater = [
        '+' => Adder::class,
    ];

    /**
     * @param $string
     * @param array $params
     * @return mixed
     */
    public function calculater($string, $params = [])
    {
        list($cal, $string) = explode(' ', $string, 2);

        if (!isset($this->calculater[$cal])) {
            throw new Exception(ErrorCode::$ENUM_SYSTEM_ERROR);
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
                    throw new Exception(ErrorCode::$ENUM_CALCULATER_STRING_INVALID);
                }

                if (is_numeric($result[1])) {
                    $arguments[] = $params[$result[1]];
                } else {
                    $arguments[] = $this->calculater($result[1], $params);
                }
            }
        }

        $calculater = new $this->calculater[$cal](...$arguments);
        return $calculater->handle();
    }

}