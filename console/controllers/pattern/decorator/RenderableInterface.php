<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午3:37
 */

namespace console\controllers\pattern\decorator;

/**
 * 创建渲染接口。
 * 这里的装饰方法 renderData() 返回的是字符串格式数据。
 */
interface RenderableInterface
{
    public function renderData(): string;
}