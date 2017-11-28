<?php
namespace console\controllers\Test;

use backend\src\models\AuthItemModel;
use Carbon\Carbon;
use yii\console\Controller;
use Yii;

class RbacController extends Controller
{
    public function actionInit()
    {
        $trance = Yii::$app->db->beginTransaction();
        $permissions = [];
        try {
            $permissions = [];
            $dirs = dirname(dirname(dirname(dirname(__FILE__)))) . '/backend/controllers';
            $controllers = $this->getFile($dirs);
            foreach ($controllers ?? [] as $controller) {
                $content = file_get_contents($controller);
                preg_match('/class ([a-zA-Z]+)Controller/', $content, $match);
                $str = '/';

                $Interface = substr($controller, strlen($dirs));
                $num = strripos($Interface, '/');
                if (isset($num)) {
                    $str = substr($Interface, 0, $num) . '/';
                }

                $cName = $str . $match[1];

                $permissions[] = strtolower($cName . '/*');

                preg_match_all('/public function action([a-zA-Z]+)/', $content, $matches);
                foreach ($matches[1] ?? [] as $aName) {
                    $permissions[] = strtolower($cName . '/' . preg_replace('/((?<=[a-z])(?=[A-Z]))/', '-', $aName));
                }
            }
            foreach ($permissions as $permission) {
                $user_model = AuthItemModel::find()->where(['name' => $permission])->one();
                if (!$user_model) {
                    $this->setAuthItem($permission);
                }
            }
            $trance->commit();
            dump('import success');
        } catch (\Exception $e) {
            $trance->rollBack();
            dump('import error' . $e->getMessage());
        }
    }

    /**
     * @param $permission
     */
    public function setAuthItem($permission)
    {
        $model = new AuthItemModel();
        $model->name = $permission;
        $model->type = 2;
        $model->description = $permission;
        $model->created_at = Carbon::now();
        $model->updated_at = Carbon::now();
        dump($model->save());
    }

    /**
     * 获取文件
     * @param $dirs
     * @return array
     */
    public function getFile($dirs)
    {
        $controllers = [];
        $files = glob($dirs . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                $controllers[] = $file;
            } else {
                $dir_controllers = $this->getFile($file);
                $controllers = array_merge($controllers, $dir_controllers);
            }
        }
        return $controllers;
    }
}