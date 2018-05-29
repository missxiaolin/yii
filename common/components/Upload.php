<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/29
 * Time: 下午9:19
 */

namespace common\components;

//引入鉴权类
use common\components\Common\InstanceTrait;
use Qiniu\Auth;
//引入上传类
use Qiniu\Storage\UploadManager;
use Yii;


class Upload
{
    use InstanceTrait;

    public $ak;

    public $sk;

    public $bucket = 'ceshi';

    public function __construct()
    {
        $this->ak = Yii::$app->params['ak'];
        $this->sk = Yii::$app->params['sk'];
    }

    /**
     * @param $file
     * @return null|string
     * @throws \Exception
     */
    public function image($file)
    {
        $ext = '.jpg';

        // 构建一个鉴权对象
        $auth = new Auth($this->ak, $this->sk);
        //生成上传的token
        $token = $auth->uploadToken($this->bucket);
        // 上传到七牛后保存的文件名
        $key = date('Y') . "/" . date('m') . "/" . substr(md5($file), 0, 5) . date('YmdHis') . rand(0, 9999) . '.' . $ext;

        //初始UploadManager类
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);

        if ($err !== null) {
            return null;
        } else {
            return $key;
        }
    }
}