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

    public $uptime;

    public $memory;

    public function __construct()
    {
        $this->cpu = $this->initCPU();
        $this->uptime = $this->initUptime();
        $this->memory = $this->initMemory();
    }

    public function getCPU()
    {
        return $this->cpu;
    }

    public function getUptime()
    {
        return $this->uptime;
    }

    public function getMemory()
    {
        return $this->memory;
    }

    abstract protected function initCPU(): CPUModel;

    abstract protected function initUptime(): string;

    abstract protected function initMemory(): Memory;
}