<?php
namespace console\jobs;
use yii\helpers\ArrayHelper;
/**
 * 处理订单的异步任务
 *
 * Class OrderJob
 * @package console\jobs
 */
class OrderJob
{
    /**
     * 执行任务的前置条件
     */
    public function setUp()
    {
        dump("===> 这里放一些任务执行之前需要处理的逻辑代码");
    }
    public function perform()
    {
        dump("这里可以接受参数的哦，比方说我们取一下order_id:" . ArrayHelper::getValue($this->args, 'id'));
        dump("这里是具体的处理订单的逻辑代码");
    }
    /**
     * 执行任务的后置条件
     */
    public function tearDown()
    {
        dump("===> 这里放一些任务处理之后需要处理的逻辑代码");
    }
}