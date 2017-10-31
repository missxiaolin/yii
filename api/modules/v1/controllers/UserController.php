<?php
namespace api\modules\v1\controllers;

class UserController extends BaseController
{
    protected $except = ['index'];

    public function actionIndex()
    {
        $data = [];
        return $this->apiResponse($data);
    }
}