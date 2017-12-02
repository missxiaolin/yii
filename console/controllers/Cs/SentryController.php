<?php
namespace console\controllers\Cs;

use yii\console\Controller;
use Exception;
use Yii;

class SentryController extends Controller
{
    public function actionIndex()
    {
        Yii::error('错误信息');
    }
}