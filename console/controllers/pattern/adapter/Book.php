<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午1:46
 */

namespace console\controllers\pattern\adapter;


class Book implements BookInterface
{
    /**
     * @var int
     */
    private $page;

    public function open()
    {
        $this->page = 1;
    }

    public function turnPage()
    {
        $this->page++;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}