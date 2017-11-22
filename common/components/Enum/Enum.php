<?php
namespace common\components\Enum;

use Phalcon\Text;
use Phalcon\Annotations\Adapter\Memory as MemoryAdapter;
use ReflectionClass;

abstract class Enum
{
    public static $_instance;

    public $_adapter = 'memory';

    public $_expire = 3600;

    public function __construct()
    {

    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (isset(static::$_instance) && static::$_instance instanceof Enum) {
            return static::$_instance;
        }

        return static::$_instance = new static();
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        return static::getInstance()->$method(...$arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return string
     */
    public function __call($name, $arguments)
    {
        $code = $arguments[0];
        $name = strtolower(substr($name, 3));

        if (isset($this->$name)) {
            return isset($this->$name[$code]) ? $this->$name[$code] : '';
        }

        // 获取注释
        $adapter = new MemoryAdapter();
        $reflection = $adapter->get(static::class);
        $annotations = $reflection->getPropertiesAnnotations();

        // 获取变量
        $ref = new ReflectionClass(static::class);
        $properties = $ref->getDefaultProperties();
        foreach ($properties as $key => $val) {
            if (Text::startsWith($key, 'ENUM_') && isset($annotations[$key])) {
                // 获取对应注释
                $ret = $annotations[$key]->get(Text::camelize($name));
                $this->$name[$val] = $ret->getArgument(0);
            }
        }

        return isset($this->$name[$code]) ? $this->$name[$code] : '';
    }


}