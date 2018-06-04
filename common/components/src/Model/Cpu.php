<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 上午11:01
 */

namespace common\components\src\Model;

class Cpu extends Model
{
    public $core;

    public $processor;

    public $cores;

    public $model;

    /**
     * Cpu constructor.
     * @param $core
     * @param $processor
     * @param $cores
     * @param $model
     */
    public function __construct($core, $processor, $cores, $model)
    {
        $this->core = $core;
        $this->processor = $processor;
        $this->cores = $cores;
        $this->model = $model;
    }
}