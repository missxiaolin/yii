<?php

namespace common\src\app\support\service;


use common\src\app\support\repository\ShopsRepository;

class ShopsService
{

    public function getList($param)
    {
        $shops_repository = new ShopsRepository();
        return $shops_repository->getList($param);
    }

}