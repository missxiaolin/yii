<?php namespace common\src\foundation\domain;

abstract class ValueObject
{
    /**
     * Determine if the object is equal to another.
     * You can use operator "==" to compare two value objects in most of the
     * time. This method is just used in case you have to specify different
     * private properties for a value object for some reasons.
     *
     * @param \common\src\foundation\domain\ValueObject $object
     * @return bool
     */
    public function isEqualTo(ValueObject $object)
    {
        if (get_class($object) != get_class($this)) {
            return false;
        }
        foreach (get_object_vars($object) as $key => $value) {
            if ($value instanceof ValueObject) {
                if (!$value->isEqualTo($this->$key)) {
                    return false;
                }
            } elseif ($value != $this->$key) {
                return false;
            }
        }

        return true;
    }
}