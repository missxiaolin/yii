<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午3:38
 */

namespace console\controllers\pattern\decorator;

/**
 * 创建 Webservice 服务类实现 RenderableInterface。
 * 该类将在后面为装饰者实现数据的输入。
 */
class Webservice implements RenderableInterface
{
    /**
     * @var string
     */
    private $data;

    /**
     * 传入字符串格式数据。
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * 实现 RenderableInterface 渲染接口中的 renderData() 方法。
     * 返回传入的数据。
     */
    public function renderData(): string
    {
        return $this->data;
    }
}