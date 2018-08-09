<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/9
 * Time: 下午2:48
 */

namespace console\controllers\pattern\abs;

/**
 * 在这种情况下，抽象工厂是创建一些组件的契约
 * 在 Web 中。 有两种呈现文本的方式：HTML 和 JSON
 */
abstract class AbstractFactory
{
    abstract public function createText(string $content): Text;
}