<?php
namespace console\controllers\Cs;

use common\components\jobs\ThingJob;
use Yii;
use yii\helpers\ArrayHelper;
use yii\console\Controller;

class JobController extends Controller
{
    /**
     * 测试脚本
     */
    public function actionTest()
    {
        Yii::$app->queue->push(new ThingJob([
            'url' => 'http://example.com/image.jpg',
        ]));
    }
}