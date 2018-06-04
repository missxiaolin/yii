<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 下午1:38
 */

namespace common\components\src\Model;


class Memory extends Model
{
    public $total;

    public $free;

    public $buffers;

    public $cached;

    public $used;

    public $percent;

    public $cachedPercent;

    /**
     * Memory constructor.
     * @param $total
     * @param $free
     * @param $buffers
     * @param $cached
     * @param $used
     * @param $percent
     * @param $cachedPercent
     */
    public function __construct($total, $free, $buffers, $cached, $used, $percent, $cachedPercent)
    {
        $this->total = $total;
        $this->free = $free;
        $this->buffers = $buffers;
        $this->cached = $cached;
        $this->used = $used;
        $this->percent = $percent;
        $this->cachedPercent = $cachedPercent;
    }
}