<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/14
 * Time: 下午4:09
 */

namespace console\controllers\pattern\registry;

/**
 * 创建注册表抽象类。
 * Class Registry
 * @package console\controllers\pattern\registry
 */
abstract class Registry
{
    const LOGGER = 'logger';

    /**
     * 这里将在你的应用中引入全局状态，但是不可以被模拟测试。
     * 因此被视作一种反抗模式！使用依赖注入进行替换！
     *
     * @var array
     * 定义存储值数组。
     */
    private static $storedValues = [];

    /**
     * @var array
     * 定义合法键名数组。
     * 可在此定义用户名唯一性。
     */
    private static $allowedKeys = [
        self::LOGGER,
    ];

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     * 设置键值，并保存进 $storedValues 。
     * 可视作设置密码。
     */
    public static function set(string $key, $value)
    {
        if (!in_array($key, self::$allowedKeys)) {
            throw new \InvalidArgumentException('Invalid key given');
        }

        self::$storedValues[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return mixed
     * 定义获取方法，获取已存储的对应键的值
     * 可视作验证用户环节，检查用户名是否存在，返回密码，后续验证密码正确性。
     */
    public static function get(string $key)
    {
        if (!in_array($key, self::$allowedKeys) || !isset(self::$storedValues[$key])) {
            throw new \InvalidArgumentException('Invalid key given');
        }

        return self::$storedValues[$key];
    }
}