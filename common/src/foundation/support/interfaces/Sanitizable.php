<?php namespace common\src\foundation\support\interfaces;

interface Sanitizable
{
    /**
     * Sanitize this object (either Entity or Value Object).
     * Make its property desirable quietly.
     *
     * @return $this
     */
    public function sanitize();
}