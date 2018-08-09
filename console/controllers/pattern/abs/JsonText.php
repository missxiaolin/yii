<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/9
 * Time: 下午2:49
 */

namespace console\controllers\pattern\abs;


class JsonText extends Text
{
    public $data;

    public function setData($data)
    {
        $this->data = $data;
    }
}