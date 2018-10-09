<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/10/9
 * Time: 上午11:23
 */

namespace console\controllers\Cs;

use common\components\Range\Point;
use common\components\Range\Range;
use yii\console\Controller;

class RangeController extends Controller
{
    /**
     * 测试含有重叠场景
     * @throws \common\components\Range\RangeInvalidException
     */
    public function actionTest()
    {
//        "rangeA:(2, 8)"
//        "rangeB:(6, +∞)"
//        "rangeA hasIntersection Yes"
        $rangeA = Range::builderRange(Point::builderPoint(2, false), Point::builderPoint(8, false));
        dump("rangeA:" . $rangeA);

        $rangeB = Range::builderRange(Point::builderPoint(6, false), Point::builderPositiveInfinityPoint());
        dump("rangeB:" . $rangeB);

        dd("rangeA hasIntersection " . ($rangeA->hasIntersection($rangeB) ? "Yes" : "No"));
    }

    /**
     * 测试没有重叠的场景
     * @throws \common\components\Range\RangeInvalidException
     */
    public function actionTest1()
    {
        $rangeA = Range::builderRange(Point::builderPoint(2, false), Point::builderPoint(8, false));
        dump("rangeA:" . $rangeA);

        $rangeB = Range::builderRange(Point::builderPoint(10, false), Point::builderPositiveInfinityPoint());
        dump("rangeB:" . $rangeB);

        dd("rangeA hasIntersection " . ($rangeA->hasIntersection($rangeB) ? "Yes" : "No"));
    }
}