<?php namespace common\src\foundation\support\exceptions;

use RuntimeException;

class MinimumReached extends RuntimeException
{
    /**
     * The minimum.
     *
     * @var int
     */
    public $minimum;

    /**
     * Create the exception and parse the minimum.
     *
     * @param int $minimum
     */
    public function __construct($minimum)
    {
        $this->minimum = $minimum;
    }
}