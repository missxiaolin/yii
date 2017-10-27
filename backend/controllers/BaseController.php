<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class BaseController extends Controller
{
    /**
     * @param $view
     * @param array $data
     * @return mixed
     */
    public function view($view, $data = array())
    {
        $data = array_merge(
            [
                'meta_title' => '小林后台信息管理系统',
                'meta_keyword' => '小林后台信息管理系统',
                'meta_description' => '小林后台信息管理系统',
            ],
            $data
        );
        return $this->render($view, $data);
    }

}
