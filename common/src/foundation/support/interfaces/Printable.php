<?php namespace common\src\foundation\support\interfaces;

interface Printable
{
    /**
     * Print or echo this object.
     *
     * @return string
     */
    public function __toString();
}