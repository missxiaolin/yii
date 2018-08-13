<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午1:47
 */

namespace console\controllers\pattern\adapter;


class Kindle implements EBookInterface
{
    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $totalPages = 100;

    public function pressNext()
    {
        $this->page++;
    }

    public function unlock()
    {
    }

    /**
     * 返回当前页和总页数，像 [10, 100] 是总页数100中的第10页。
     *
     * @return int[]
     */
    public function getPage(): array
    {
        return [$this->page, $this->totalPages];
    }
}