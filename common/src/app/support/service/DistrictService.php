<?php

namespace common\src\app\support\service;


use common\components\Common\InstanceTrait;
use common\components\TencentMapClient;
use common\components\Train;
use common\src\app\support\models\DistrictsModel;
use common\src\app\support\models\DistrictsTrainModel;
use common\src\app\support\repository\DistrictsRepository;
use common\src\app\support\repository\DistrictsTrainRepository;

class DistrictService
{
    use InstanceTrait;

    /**
     * @desc   返回处理到哪个城市
     * @author xiaolin
     * @return int
     */
    public function crawl()
    {
        $res = DistrictsRepository::getInstance()->findByLevel(3);
        $rid = 0;
        /** @var DistrictsModel $item */
        foreach ($res as $item) {
            $rid = $item->oid;
            dump('当前处理到 ID=' . $rid);
            $children = $item->children()->all();
            /** @var DistrictsModel $child */
            foreach ($children as $child) {
                try {
                    $res = TencentMapClient::getInstance()->suggestion($item->area_name, $child->area_name);
                } catch (\Exception $ex) {
                    dump($item->area_name . $child->area_name);
                    sleep(2);
                    $res = TencentMapClient::getInstance()->suggestion($item->area_name, $child->area_name);
                }
                if (!isset($res['data'])) {
                    dd($res);
                }
                foreach ($res['data'] ?? [] as $v) {
                    $lat = $v['location']['lat'];
                    $lon = $v['location']['lng'];

                    try {
                        $train = new DistrictsTrainModel();
                        $train->lat = $lat;
                        $train->lon = $lon;
                        $train->oid = $child->oid;
                        $train->save();

                    } catch (\Exception $ex) {
                        dump($ex->getMessage());
                    }
                }

                sleep(1);
            }
        }
        return $rid;
    }

    /**
     * 初始化数据
     * @param int $id
     * @return int|mixed
     */
    public function init($id = 0)
    {
        $res = DistrictsRepository::getInstance()->findByLevelAndId(3, $id);
        $rid = 0;
        /** @var DistrictsModel $item */
        foreach ($res as $item) {
            $rid = $item->oid;
            $children = $item->children;
            /** @var DistrictsModel $child */
            foreach ($children as $child) {
                DistrictsTrainRepository::getInstance()->add($child->lat, $child->lon, $child->oid);
                if (isset($child->children)) {
                    foreach ($child->children as $v) {
                        DistrictsTrainRepository::getInstance()->add($v->lat, $v->lon, $child->oid);
                    }
                }
            }
        }

        return $rid;
    }

    /**
     * 计算经纬度所在地区
     * @param $lat
     * @param $lon
     * @return mixed
     */
    public function predict($lat, $lon)
    {
        return Train::getInstance()->predict([$lat, $lon]);
    }
}