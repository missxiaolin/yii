<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class BaseController extends Controller
{
    // 需要验证
    protected $actions = ['*'];

    protected $except = [];

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => $this->except,
                        'allow' => true
                    ],
                    [
                        'actions' => $this->actions,
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

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
