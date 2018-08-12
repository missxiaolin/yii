<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/9
 * Time: 下午3:02
 */

namespace console\controllers\pattern\build;

use console\controllers\pattern\build\parts\Vehicle;

/**
 * 建造者模式
 * Director 类是建造者模式的一部分。 它可以实现建造者模式的接口
 * 并在构建器的帮助下构建一个复杂的对象
 *
 * 您也可以注入许多构建器而不是构建更复杂的对象
 */
class Director
{
    public function build(BuilderInterface $builder): Vehicle
    {
        $builder->createVehicle();
        $builder->addDoors();
        $builder->addEngine();
        $builder->addWheel();

        return $builder->getVehicle();
    }
}