<?php
namespace console\controllers\districts;

use common\components\Swoole\Test\TestClient;
use yii\console\Controller;

class SendController extends Controller
{
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function actionTest()
    {
        try {
            dump(TestClient::getInstance()->predict(39.9223757639, 116.4221191406));
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }
}
