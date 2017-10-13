<?php namespace common\src\foundation\support\exceptions;

use RuntimeException;

class MaximumReached extends RuntimeException
{
    /**
     * The maximum.
     *
     * @var int
     */
    public $maximum;

    /**
     * Create the exception and parse the maximum.
     *
     * @param int $maximum
     */
    public function __construct($maximum)
    {
        $this->maximum = $maximum;
    }
}