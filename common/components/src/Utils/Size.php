<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 上午10:25
 */

namespace common\components\src\Utils;


class Size
{
    /**
     * @param $bytes
     * @param int $decimals
     * @return bool|string
     */
    public static function format($bytes, $decimals = 2)
    {
        $quant = array(
            'TB' => 1099511627776, // pow( 1024, 4)
            'GB' => 1073741824, // pow( 1024, 3)
            'MB' => 1048576, // pow( 1024, 2)
            'KB' => 1024, // pow( 1024, 1)
            'B ' => 1, // pow( 1024, 0)
        );
        foreach ($quant as $unit => $mag) {
            if (doubleval($bytes) >= $mag) {
                return number_format($bytes / $mag, $decimals) . ' ' . $unit;
            }
        }
        return false;
    }
}