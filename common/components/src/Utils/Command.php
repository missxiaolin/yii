<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 上午10:24
 */

namespace common\components\src\Utils;

class Command
{
    /**
     * @param string $args
     * @param string $commandName
     * @param string $option
     * @return bool|string
     */
    public static function get($args = '', $commandName = 'sysctl', $option = '-n')
    {
        if (false === ($commandPath = static::find($commandName))) return false;

        if ($command = shell_exec("$commandPath $option $args")) {
            return trim($command);
        }
        return false;
    }

    /**
     * @param $commandName
     * @return bool|string
     */
    public static function find($commandName)
    {
        {
            $paths = ['/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin'];

            foreach ($paths as $path) {
                if (is_executable("$path/$commandName")) return "$path/$commandName";
            }
            return false;
        }
    }
}