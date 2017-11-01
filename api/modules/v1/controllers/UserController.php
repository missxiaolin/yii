<?php
namespace api\modules\v1\controllers;

class UserController extends BaseController
{
    protected $except = ['index', 'yar'];

    /**
     * 首页
     * @return array
     */
    public function actionIndex()
    {
        $data = [];
        return $this->apiResponse($data);
    }

    /**
     * RPC 调试
     */
    public function actionYar()
    {
        $client = new \Yar_Client('http://www.assets.com/test/test');
        dump($client->Hello());
    }
}