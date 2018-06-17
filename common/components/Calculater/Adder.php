<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/17
 * Time: 上午9:29
 */

namespace common\components\Calculater;

class Adder implements CalculaterInterface
{
    public $arguments;

    /**
     * Adder constructor.
     */
    public function __construct()
    {
        $this->arguments = func_get_args();
    }


    /**
     * @return float|int|string
     */
    public function handle()
    {
        $result = 0;
        foreach ($this->arguments as $arg) {
            if (is_numeric($arg)) {
                $result += $arg;
            }
            if ($arg instanceof CalculaterInterface) {
                $result += floatval($arg->handle());
            }
        }
        return $result;
    }
}