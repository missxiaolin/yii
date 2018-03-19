<?php

namespace common\src\app\support\service;


use common\components\Common\InstanceTrait;
use common\components\TencentMapClient;
use common\src\app\support\models\DistrictsModel;
use common\src\app\support\models\DistrictsTrainModel;
use common\src\app\support\repository\DistrictsRepository;

class DistrictService
{
    use InstanceTrait;

    /**
     * @desc   返回处理到哪个城市
     * @param $id
     * @author xiaolin
     * @return int
     */
    public function crawl($id = 0)
    {
        $res = DistrictsRepository::getInstance()->findByLevelAndId(3);
        $rid = 0;
        if ($res) {
            /** @var DistrictsModel $item */
            foreach ($res as $item) {
                $rid = $item->oid;
                $children = $item->children()->all();
                /** @var DistrictsModel $child */
                foreach ($children as $child) {
                    $res = TencentMapClient::getInstance()->suggestion($item->area_name, $child->area_name);
                    if (!isset($res['data'])) {
                        dd($res);
                    }
                    foreach ($res['data'] as $v) {
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
        }
    }
}