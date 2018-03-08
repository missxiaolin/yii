<?php
namespace console\controllers\Cs\work;

use Workerman\Worker;
use yii\console\Controller;
use Yii;

class CsController extends Controller
{
    public function actionTest()
    {
        $ws_worker = new Worker("websocket://0.0.0.0:2346");
        dd($ws_worker);
    }
}