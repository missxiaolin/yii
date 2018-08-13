<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午1:51
 */

namespace console\controllers\pattern\adapter;


/**
 * 这里是一个适配器. 注意他实现了 BookInterface,
 * 因此你不必去更改客户端代码当使用 Book
 *
 * Class EBookAdapter
 * @package console\controllers\pattern\adapter
 */
class EBookAdapter implements BookInterface
{
    /**
     * @var EBookInterface
     */
    protected $eBook;

    /**
     * @param EBookInterface $eBook
     */
    public function __construct(EBookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    /**
     * 这个类使接口进行适当的转换.
     */
    public function open()
    {
        $this->eBook->unlock();
    }

    public function turnPage()
    {
        $this->eBook->pressNext();
    }

    /**
     * 注意这里适配器的行为： EBookInterface::getPage() 将返回两个整型，除了 BookInterface
     * 仅支持获得当前页，所以我们这里适配这个行为
     *
     * @return int
     */
    public function getPage(): int
    {
        return $this->eBook->getPage()[0];
    }
}