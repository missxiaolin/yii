<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class BaseController extends Controller
{
    protected $title = '小林专属';
    protected $meta_title = '';
    protected $meta_keyword = '';
    protected $meta_description = '';
    protected $file_css = '';
    protected $file_js = '';

    public function setSeo($title, $keyword, $description)
    {
        $this->meta_title = $title;
        $this->meta_keyword = $keyword;
        $this->meta_description = $description;
    }

    protected function view($page, $data = [])
    {
        $view = Yii::$app->getView();
        $view->params = [
            'debug' => Yii::$app->params['debug'],
            'title' => $this->title,
            'host' => Yii::$app->params['host'],
            'base_url' => Yii::$app->params['host'] . '/js',
            'file_css' => $this->file_css,
            'file_js' => $this->file_js,
        ];

        return $this->render($page, $data);
    }


}