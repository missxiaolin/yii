<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/10/9
 * Time: 上午10:31
 */

namespace common\components\Range;

class Point
{
    /**
     * 正无穷
     */
    const POSITIVE_INFINITY = "+";

    /**
     * 负无穷
     */
    const NEGATIVE_INFINITY = "-";

    /**
     * @var float|string 数值
     */
    public $value;

    /**
     * @var bool 是否包含自己
     */
    public $includeSelf = true;

    /**
     * 私有化构造方法，不让外面直接new
     *
     * Point constructor.
     */
    private function __construct()
    {
    }

    /**
     * 构建有限集合点(不包含负无穷和正无穷的点)
     *
     * @param float $value
     * @param bool $includeSelf
     * @return Point
     */
    public static function builderPoint(float $value, bool $includeSelf)
    {
        $point = new Point();
        $point->value = $value;
        $point->includeSelf = $includeSelf;
        return $point;
    }

    /**
     * 构建正无穷的点
     *
     * @return Point
     */
    public static function builderPositiveInfinityPoint()
    {
        $point = new Point();
        $point->value = Point::POSITIVE_INFINITY;
        $point->includeSelf = false;
        return $point;
    }

    /**
     * 构建负无穷的点
     *
     * @return Point
     */
    public static function builderNegativeInfinityPoint()
    {
        $point = new Point();
        $point->value = Point::NEGATIVE_INFINITY;
        $point->includeSelf = false;
        return $point;
    }

    /**
     * 判断是否是负无穷的点
     *
     * @return bool
     */
    public function isNegativeInfinityPoint()
    {
        return $this->value === self::NEGATIVE_INFINITY;
    }

    /**
     * 判断是否是正无穷的点
     *
     * @return bool
     */
    public function isPositiveInfinityPoint()
    {
        return $this->value === self::POSITIVE_INFINITY;
    }
}