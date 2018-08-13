<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午1:47
 */

namespace console\controllers\pattern\adapter;


interface EBookInterface
{
    public function unlock();

    public function pressNext();

    /**
     * 返回当前页和总页数，像 [10, 100] 是总页数100中的第10页。
     *
     * @return int[]
     */
    public function getPage(): array;
}