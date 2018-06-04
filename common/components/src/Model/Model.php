<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/4
 * Time: 上午11:03
 */

namespace common\components\src\Model;

use ArrayAccess;


abstract class Model implements ArrayAccess
{
    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return mixed|void
     */
    public function offsetSet($offset, $value)
    {
        return $this->$offset = $value;
    }

    /**
     * @param mixed $offset
     * @return null|void
     */
    public function offsetUnset($offset)
    {
        return $this->$offset = null;
    }
}