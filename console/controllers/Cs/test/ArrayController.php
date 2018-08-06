<?php

namespace console\controllers\Cs\test;

use yii\console\Controller;
use yii\helpers\ArrayHelper;

class ArrayController extends Controller
{
    /**
     * 初始化
     */
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        echo 'Help:' . PHP_EOL;
        echo 'array函数参数测试' . PHP_EOL;

        echo 'Usage:' . PHP_EOL;
        echo './yii Cs/test/array [action]' . PHP_EOL;

        echo 'Actions:' . PHP_EOL;

        echo 'chunk                     数组重新分组' . PHP_EOL;
        echo 'case      [upper|lower]   修改键名为全大写或小写' . PHP_EOL;
        echo 'combine                   拼接key数组和val数组' . PHP_EOL;
        echo 'count                     统计数组中所有的值出现的次数' . PHP_EOL;
        echo 'diff                      计算数组差集' . PHP_EOL;
        echo 'fill                      用给定的值填充数组' . PHP_EOL;
        echo 'filter                    用回调函数过滤数组中的单元' . PHP_EOL;
        echo 'intersect                 返回两个数组值的差集，如果值相等返回数组1对应的数据' . PHP_EOL;
        echo 'keys                      返回数组的key值' . PHP_EOL;
        echo 'map                       返回callback处理之后的数组' . PHP_EOL;
        echo 'unique                    数组去重' . PHP_EOL;
        echo 'mergeRecursive            合并多个数组，键值相同则合并成一个数组' . PHP_EOL;
        echo 'pad       [:len] [:val]   根据指定长度填充数组' . PHP_EOL;
        echo 'splice    [:off] [:len]   根据指定长度切割' . PHP_EOL;
        echo 'multisort                 数组排序' . PHP_EOL;
        echo 'intersectKey              返回两个数组KEY的差集 若KEY相等返回数组1对应的数据' . PHP_EOL;
        echo 'flip                      KEY和VALUE互换' . PHP_EOL;
        echo 'fillKeys                  填充数据' . PHP_EOL;
        echo 'arrayGet                  提取数据' . PHP_EOL;
        echo 'arrayArrayWalk            循环数据' . PHP_EOL;
    }

    /**
     * 数组重新分组
     */
    public function actionChunk()
    {
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        echo '原数组：' . PHP_EOL;
        dump($arr);
        $res = array_chunk($arr, 4);
        dump($res);
        echo '4个一组分组：' . PHP_EOL;
        $res = array_chunk($arr, 20);
        dump($res);
        echo '20个一组分组：' . PHP_EOL;
    }

    /**
     * 修改键名为全大写或小写
     * [upper|lower]
     * @param $params string
     */
    public function actionCase($params = '')
    {
        if (strlen($params) == 0) {
            dump('请输入参数！upper|lower');
            return;
        }
        $type = $params == 'upper' ? CASE_UPPER : CASE_LOWER;
        $data = ['test' => 'tt', 'Tes' => 123, 'AA' => 'sdf'];
        echo '原数组' . PHP_EOL;
        dump($data);
        echo 'array_change_key_case(data,type)' . PHP_EOL;
        dump(array_change_key_case($data, $type));
    }

    /**
     * 拼接key数组和val数组
     */
    public function actionCombine()
    {
        $key = ['key1', 'key2', 'key3'];
        $val = ['val1', 'val2', 'val3'];
        echo '原数组：' . PHP_EOL;
        dump($key);
        dump($val);
        echo '结果：' . PHP_EOL;
        dump(array_combine($key, $val));
    }

    /**
     * 统计数组值出现的次数
     */
    public function actionCount()
    {
        $data = [1, 2, 'hello', 1, 'hello', 'hello', '1'];
        echo '原数组：' . PHP_EOL;
        dump($data);
        dump(array_count_values($data));
    }

    /**
     * 计算数组差集
     */
    public function actionDiff()
    {
        $arr1 = [1, 2, 3, '4' => 4, '5' => 5, 6, 7];
        $arr2 = [2, 3, '5' => 5, '6' => 5, 6, 8];
        echo '原数组：' . PHP_EOL;
        dump($arr1);
        dump($arr2);
        echo '结果：' . PHP_EOL;
        dump(array_diff($arr1, $arr2));
    }

    /**
     * 用给定的值填充数组
     * ./yii Cs/test/array/fill 0,3,t(数组传递)
     * @param array $params
     * @return bool
     */
    public function actionFill(array $params)
    {
        if (count($params) < 3) {
            dump('请输入起始值和长度和值');
            return false;
        }
        $begin = $params[0];
        $len = $params[1];
        $val = $params[2];
        if (!is_numeric($begin) || !is_numeric(($len))) {
            dump('起始值和长度必须为INT');
            return false;
        }
        $res = array_fill($begin, $len, $val);
        dump($res);
    }

    /**
     * 用回调函数过滤数组中的单元
     */
    public function actionFilter()
    {
        $arr = [1, 2, 3, 'a' => 4, 5, 6, 7, 'b' => 9, 8, 10];
        echo '原数组：' . PHP_EOL;
        dump($arr);
        echo '结果：' . PHP_EOL;
        dump(array_filter($arr, function ($var) {
            return ($var & 1);
        }));

        dump(array_filter($arr, function ($var) {
            return ($var > 4);
        }));
    }

    /**
     * 返回两个数组值的差集，如果值相等返回数组1对应的数据
     */
    public function actionIntersect()
    {
        $arr1 = array("a" => "green", "red", "blue");
        $arr2 = array("b" => "green", "yellow", "red");
        echo '原数组：' . PHP_EOL;
        dump($arr1);
        dump($arr2);
        echo '结果：' . PHP_EOL;
        dump(array_intersect($arr1, $arr2));
    }

    /**
     * 返回数组的key值
     */
    public function actionKeys()
    {
        $arr = array("a" => "green", "red", "blue", "b" => "green", 22 => "yellow", "red");
        echo '原数组：' . PHP_EOL;
        dump($arr);
        echo '结果：' . PHP_EOL;
        dump(array_keys($arr));
    }

    /**
     * 返回callback处理之后的数组
     */
    public function actionMap()
    {
        $arr = [1, 2, 3, 4, 5];
        echo '原数组：' . PHP_EOL;
        dump($arr);
        echo '结果：' . PHP_EOL;
        dump(array_map(function ($val) {
            return $val > 2 ? $val : '';
        }, $arr));
    }

    /**
     * 数组去重
     */
    public function actionUnique()
    {
        $arr = [1, 1, 222, 222, 3, 4, 5];
        echo '原数组：' . PHP_EOL;
        dump($arr);
        echo '结果：' . PHP_EOL;
        dump(array_unique($arr));
    }

    /**
     * 合并多个数组，键值相同则合并成一个数组
     */
    public function actionMergeRecursive()
    {
        $arr1 = ["color" => ["favorite" => "red"], 5];
        $arr2 = [10, "color" => ["favorite" => "green", "blue"]];
        echo '原数组：' . PHP_EOL;
        dump($arr1);
        dump($arr2);
        echo '结果：' . PHP_EOL;
        dump(array_merge_recursive($arr1, $arr2));
    }

    /**
     * 根据指定长度填充数组
     * @param $params
     */
    public function actionPad(array $params)
    {
        if (count($params) < 2) {
            dump('请输入数组长度 与 填充值！');
            return;
        }
        $arr = [1, 2, 3, 4, 5];
        echo '原数组：' . PHP_EOL;
        dump($arr);
        echo '结果：' . PHP_EOL;
        dump(array_pad($arr, $params[0], $params[1]));

    }

    /**
     * 根据指定长度切割
     * @param $params
     */
    public function actionSplice(array $params)
    {
        if (count($params) < 2) {
            dump('请输入起始位置 与 长度！');
            return;
        }
        $arr = [1, 2, 3, 4, 5];
        echo '原数组：' . PHP_EOL;
        dump($arr);
        echo '结果：' . PHP_EOL;

        dump(array_splice($arr, $params[0], $params[1]));

    }

    /**
     * 数组排序
     */
    public function actionMultisort()
    {
        $arr = [];
        $sort1 = [];
        $sort2 = [];
        for ($i = 0; $i < 100; $i++) {
            $s1 = rand(1, 10);
            $s2 = rand(1, 100);
            $arr[] = ['sort1' => $s1, 'sort2' => $s2, 'val' => uniqid()];
            $sort1[] = $s1;
            $sort2[] = $s2;
        }
        echo '原数组：' . PHP_EOL;
        echo json_encode($arr) . PHP_EOL;
        echo '结果：' . PHP_EOL;
        $data = array_multisort($sort1, SORT_DESC, $sort2, SORT_ASC, $arr);
        dump($data);
    }

    /**
     * 返回两个数组KEY的差集 若KEY相等返回数组1对应的数据
     */
    public function actionIntersectKey()
    {
        $arr1 = ['id' => 1, 'name' => 'xiaolin', 'username' => 'xiaolin'];
        $arr2 = ['id' => 0, 'name' => 1, 'username' => 2, 'email' => '462441355@qq.com'];
        echo '原数组：' . PHP_EOL;
        dump($arr1);
        dump($arr2);
        echo '结果：' . PHP_EOL;
        dump(array_intersect_key($arr1, $arr2));
    }

    /**
     * KEY和VALUE互换
     */
    public function actionFlip()
    {
        $arr = ['id', 'name', 'username'];
        echo '原数组：' . PHP_EOL;
        dump($arr);
        echo '结果：' . PHP_EOL;
        dump(array_flip($arr));
    }

    /**
     * 填充数据
     */

    public function actionFillKeys()
    {
        $arr = ['id', 'name', 'username'];
        echo '原数组：' . PHP_EOL;
        dump($arr);
        echo '结果：' . PHP_EOL;
        dump(array_fill_keys($arr, ''));
    }

    /**
     * 提取数据
     */
    public function actionArrayGet()
    {
        $arr = [
            'shop_no' => 5325210415012312,
        ];
        dump(ArrayHelper::getValue($arr, 'shop_no'));
    }

    public function actionArrayWalk()
    {
        $arr = [
            'a' => 1,
            'b' => 2,
        ];
        array_walk($arr, function ($v, $k) use (&$arr) {
            $arr[$k] = $v * 2;
        });
        dump($arr);
    }
}