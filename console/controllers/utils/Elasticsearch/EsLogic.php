<?php
namespace console\controllers\utils\Elasticsearch;

class EsLogic
{
    const LAT = 31.249162;
    const LON = 121.487899;

    /**
     * @return string
     */
    public static function getRandomLat()
    {
        $num = rand(1, 1000);
        $lat = static::LAT;
        return bcadd($lat, $num / 100000, 6);
    }

    /**
     * @return string
     */
    public static function getRandomLon()
    {
        $num = rand(1, 1000);
        $lon = static::LON;
        return bcadd($lon, $num / 100000, 6);
    }

    /**
     * @return false|string
     */
    public static function getRandomDate()
    {
        $time = time();
        $rand = rand(-9999999, 9999999);
        $time = $time + $rand;

        return date('Y-m-d', $time);
    }

    /**
     * @return mixed
     */
    public static function getRandomName()
    {
        $arr = [
            '老李', 'Agnes', 'xiaolin', '杰克 马', '小林',
            '老徐', '小王', '王 小虎',
        ];

        $id = rand(0, count($arr) - 1);
        return $arr[$id];
    }

    /**
     * @return mixed
     */
    public static function getRandomBook()
    {
        $arr = [
            '三天放弃php', '七天精通java', '14天熟练使用div/css', '28天成就PHP大神', '1月精通各种操作OS',
            '2月精通golang', 'go协程详解', '颈椎病回复指南',
        ];

        $id = rand(0, count($arr) - 1);
        return $arr[$id];
    }

    /**
     * @param $id
     * @return bool
     */
    public static function add($id)
    {
        $client = Client::getInstance();
        $params = [
            'index' => ES::ES_INDEX,
            'type' => ES::ES_TYPE_USER,
            'id' => $id,
            'body' => [
                'name' => EsLogic::getRandomName(),
                'age' => rand(1, 99),
                'birthday' => EsLogic::getRandomDate(),
                'book' => [
                    'author' => EsLogic::getRandomName(),
                    'name' => EsLogic::getRandomBook(),
                    'publish' => EsLogic::getRandomDate(),
                    'desc' => EsLogic::getRandomBook() . ' 不在话下。',
                ],
                'location' => [
                    'lat' => EsLogic::getRandomLat(),
                    'lon' => EsLogic::getRandomLon(),
                ],
                'randnum' => rand(1, 999999),
            ],
        ];
        try {
            $res = $client->index($params);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }
}