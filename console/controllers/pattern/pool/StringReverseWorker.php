<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 上午10:30
 */

namespace console\controllers\pattern\pool;


class StringReverseWorker
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @param string $text
     * @return string
     */
    public function run(string $text)
    {
        return strrev($text);
    }
}