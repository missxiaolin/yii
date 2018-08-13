<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午1:45
 */

namespace console\controllers\pattern\adapter;

// 将一个类的接口转换成可应用的兼容接口。适配器使原本由于接口不兼容而不能一起工作的那些类可以一起工作。

/**
 * 适配器模式
 * 使用多个不同的网络服务和适配器来规范数据使得出结果是相同的
 * Class BookInterface
 */
interface BookInterface
{
    public function turnPage();

    public function open();

    public function getPage(): int;
}