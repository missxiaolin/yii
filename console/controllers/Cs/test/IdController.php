<?php
namespace console\controllers\Cs\test;

use yii\console\Controller;
use Yii;
use Exception;

class IdController extends Controller
{
    /** @var  integer 毫秒 */
    protected $beginAt;

    /**
     * 根据订单ID或者用户ID获取数据库名
     * @param null $id
     * @param null $userId
     */
    public function actionId($id = null, $userId = null)
    {
        if (isset($id)) {
            $num = str_pad(decbin($id), 64, '0', STR_PAD_LEFT);
            $bit = substr($num, 42, 10); // userId 的10个bit位
            $bit = substr($bit, -3, 3);
            dump(bindec($bit));
        }

        $bit = decbin($userId);
        $bit = substr($bit, -3, 3);
        dump(bindec($bit));
    }

    /**
     * @param $userId
     */
    public function actionOrderId($userId)
    {
        try{
            $userId = intval($userId);
            dump($this->id($userId % 1024, rand(0, 4095)));
        }catch (\Exception $e){
            dump($e->getMessage());
        }
    }


    /**
     * @desc   获取唯一ID的方法
     * @param $workerId
     * @param $sequenceId
     * @param null $currentTime
     * @return number
     * @throws Exception
     */
    public function id($workerId, $sequenceId, $currentTime = null)
    {
        if ($workerId < 0 || $workerId > 1023 || !is_int($workerId)) {
            throw new Exception('workerId 只能在 0-1023 之间的整数');
        }

        if ($sequenceId < 0 || $sequenceId > 4095 || !is_int($sequenceId)) {
            throw new Exception('sequenceId 只能在 0-4095 之间的整数');
        }

        $time = $this->getBeginAt();

        if (!isset($currentTime)) {
            $currentTime = time();
        }

        $bit1 = str_pad(decbin($currentTime - $time), 41, '0', STR_PAD_LEFT);
        $bit2 = str_pad(decbin($workerId), 10, '0', STR_PAD_LEFT);
        $bit3 = str_pad(decbin($sequenceId), 12, '0', STR_PAD_LEFT);

        return bindec('0' . $bit1 . $bit2 . $bit3);
    }

    /**
     * @desc   返回起始时间 秒
     * @author limx
     * @return int
     */
    public function getBeginAt()
    {
        if (isset($this->beginAt) && is_numeric($this->beginAt)) {
            return $this->beginAt;
        }

        return strtotime('2017-01-01');
    }
}