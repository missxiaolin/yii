<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 上午11:14
 */

namespace console\controllers\pattern\prototype;

// 相比正常创建一个对象 ( new Foo() )，首先创建一个原型，然后克隆它会更节省开销。
abstract class BookPrototype
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $category;

    abstract public function __clone();

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
}