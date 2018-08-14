<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/14
 * Time: 下午5:48
 */

namespace console\controllers\pattern\responsibility;


class FastStorage extends Handler
{
    /**
     * @var array
     */
    protected $data = array();

    /**
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->data = $data;
    }

    protected function processing(Request $req)
    {
        if ('get' === $req->verb) {
            if (array_key_exists($req->key, $this->data)) {
                $req->response = $this->data[$req->key];
                return '测试2';
            }
        }

        return false;
    }
}