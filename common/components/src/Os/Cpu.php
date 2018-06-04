<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 上午10:22
 */

namespace common\components\src\Os;


use common\components\src\Model\Memory;
use common\components\src\Model\Cpu as CPUModel;

abstract class Cpu
{
    public $cpu;

    public function __construct()
    {
        $this->cpu = $this->initCPU();
    }

    public function getCPU()
    {
        return $this->cpu;
    }

    abstract protected function initCPU(): CPUModel;

    abstract protected function initUptime(): string;

    abstract protected function initMemory(): Memory;
}