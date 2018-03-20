<?php
namespace common\components;


use common\components\Common\InstanceTrait;
use common\src\app\support\models\DistrictsTrainModel;
use common\src\app\support\repository\DistrictsTrainRepository;
use Phpml\Classification\KNearestNeighbors;

class Train
{
    use InstanceTrait;

    /** @var KNearestNeighbors */
    public $classifier;

    public function __construct()
    {
        $classifier = new KNearestNeighbors();
        $id = 0;
        while (true) {
            $samples = DistrictsTrainRepository::getInstance()->findById($id);
            if (count($samples) === 0) {
                break;
            }
            $trans = [];
            $result = [];

            /** @var DistrictsTrainModel $item */
            foreach ($samples as $item) {
                $trans[] = [$item->lat, $item->lon];
                $result[] = $item->oid;
                $id = $item->id;
            }
            $classifier->train($trans, $result);
        }

        $this->classifier = $classifier;
    }

    public function __call($name, $arguments)
    {
        return $this->classifier->$name(...$arguments);
    }
}