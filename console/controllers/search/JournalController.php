<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/1
 * Time: 下午6:23
 */

namespace console\controllers\search;


use console\controllers\utils\Elasticsearch\Client;
use console\controllers\utils\Elasticsearch\ElkAsyncReporter;
use console\controllers\utils\Elasticsearch\ES;

class JournalController
{

    /**
     * @param $id
     * @return mixed
     */
    protected function getElasticSearchInfoById($id)
    {
        $client = Client::getInstance();
        $res = $client->search([
            'index' => ES::ES_INDEX,
            'type' => ES::ELK_TYPE,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            ['term' => ['context.id' => $id]],
                        ],
                    ]
                ],
                'size' => 1,
            ],
        ]);

        return $res['hits'];
    }

    /**
     * 落日志
     */
    public function actionTest()
    {
        $id = uniqid();
        ElkAsyncReporter::getInstance()->log('debug', 'id:{id}, I am {name}', ['name' => 'limx', 'id' => $id]);
        sleep(5);

        $res = $this->getElasticSearchInfoById($id);
        dump($res);
    }

}