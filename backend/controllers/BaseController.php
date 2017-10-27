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
     * @param $page
     * @param array $data
     * @return mixed
     */
    public function view($page, $data = array())
    {
        $view = Yii::$app->getView();
        $view->params = [
            'meta_title' => '小林后台信息管理系统',
            'meta_keyword' => '小林后台信息管理系统',
            'meta_description' => '小林后台信息管理系统',
        ];
        return $this->render($page, $data);
    }

}
