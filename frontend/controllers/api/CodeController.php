<?php
namespace frontend\controllers\api;


use common\components\GeetestLib;
use yii\web\Controller;
use yii\web\Response;
use Yii;


class CodeController extends Controller
{
    /**
     * @return mixed
     */
    public function actionStart()
    {
        $data = [];
        Yii::$app->response->format = Response::FORMAT_JSON;
        $type = Yii::$app->request->get('type');
        if ($type == 'pc') {
            $GtSdk = new GeetestLib('d302b753264fec3232d348bec90eaa12', '413fa78d6a3e91c664ec4aa17db183d3');
        } elseif ($type == 'mobile') {
            $GtSdk = new GeetestLib('d302b753264fec3232d348bec90eaa12', '413fa78d6a3e91c664ec4aa17db183d3');
        }
        $user_id = "test";

        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;

        return $GtSdk->get_response_str();
    }

    /**
     * @return array
     */
    public function actionVerify()
    {
        $data = [];
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $type = $post['type'];
        if ($type == 'pc') {
            $GtSdk = new GeetestLib('d302b753264fec3232d348bec90eaa12', '413fa78d6a3e91c664ec4aa17db183d3');
        } elseif ($type == 'mobile') {
            $GtSdk = new GeetestLib('d302b753264fec3232d348bec90eaa12', '413fa78d6a3e91c664ec4aa17db183d3');
        }
        $user_id = $_SESSION['user_id'];
        if ($_SESSION['gtserver'] == 1) {   //服务器正常
            $result = $GtSdk->success_validate($post['geetest_challenge'], $post['geetest_validate'], $_POST['geetest_seccode'], $user_id);
            if ($result) {
                $data['success'] = true;
                return $data;
            } else {
                $data['success'] = false;
                return $data;
            }
        } else {  //服务器宕机,走failback模式
            if ($GtSdk->fail_validate($post['geetest_challenge'], $post['geetest_validate'], $post['geetest_seccode'])) {
                $data['success'] = true;
                return $data;
            } else {
                $data['success'] = false;
                return $data;
            }
        }
    }
}