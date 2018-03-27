<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\ExitException;
use yii\web\HttpException;

class Error extends Component
{
    public function register()
    {
        ini_set('display_errors', false);
        set_exception_handler([$this, 'handleException']);
    }

    public function handleException($exception)
    {
        dd($exception);
    }
}