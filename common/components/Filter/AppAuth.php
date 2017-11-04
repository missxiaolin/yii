<?php
namespace common\components\Filter;

use yii\base\ActionFilter;
use Yii;

/**
 * 过滤器
 * Class AppAuth
 * @package common\components\Filter
 */
class AppAuth extends ActionFilter
{
    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        echo '在调用action前显示<br/>';
        return true;//如果返回值为false,则action不会运行
    }

    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return string
     */
    public function afterAction($action, $result)
    {
        return '在调用action后显示<br/>';//可以对action输出的$result进行过滤，retun的内容会直接显示
    }
}