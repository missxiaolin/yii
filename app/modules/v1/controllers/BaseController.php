<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\rest\Controller;


class BaseController extends Controller
{
    /**
     * @param $data
     * @param string $code
     * @param string $msg
     * @return array
     */
    public function apiResponse($data, $code = '0', $msg = 'ok')
    {
        $json = [
            'data' => $data,
            'code' => $code,
            'msg' => $msg,
            'time' => (string)time(),
            '_ut' => (string)round(microtime(TRUE) - $_SERVER['REQUEST_TIME_FLOAT'], 5),
        ];
        return $json;
    }

}
