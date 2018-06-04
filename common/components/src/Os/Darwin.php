<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 上午10:19
 */

namespace common\components\src\Os;


use common\components\Common\InstanceTrait;
use common\components\src\Utils\Command;
use common\components\src\Utils\Size;

class Darwin extends CPU implements OSInterface
{
    use InstanceTrait;

    /**
     * @return mixed
     */
    public function svr_darwin()
    {
        $swapInfo = Command::get("vm.swapusage");
        $swap1 = preg_split('/M/', $swapInfo);
        $swap2 = preg_split('/=/', $swap1[0]);
        $swap3 = preg_split('/=/', $swap1[1]);
        $swap4 = preg_split('/=/', $swap1[2]);

        $sTotal = $swap2[1] * 1024 * 1024;
        $sUsed = $swap3[1] * 1024 * 1024;
        $sFree = $swap4[1] * 1024 * 1024;

        $res['swapTotal'] = Size::format($sTotal, 1);
        $res['swapFree'] = Size::format($sFree, 1);
        $res['swapUsed'] = Size::format($sUsed, 1);
        $res['swapPercent'] = (floatval($sTotal) != 0) ? round($sUsed / $sTotal * 100, 1) : 0;

        $res['mBool'] = true;
        $res['cBool'] = true;
        $res['rBool'] = false;
        $res['sBool'] = true;

        // CPU状态
        $cpustat = Command::get(1, 'sar', '');
        if ($cpustat !== false) {
            preg_match_all("/Average\s{0,}\:+\s+\w+\s+\w+\s+\w+\s+\w+/s", $cpustat, $_cpu);
            $_cpu = preg_split("/\s+/", $_cpu[0][0]);
            $percent = $_cpu[1] + $_cpu[2] + $_cpu[3];
            $res['cpu']['percent'] = $percent;
        }

        return $res;
    }
}