<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/1
 * Time: 下午6:30
 */

namespace console\controllers;


use console\controllers\utils\Elasticsearch\Client;
use console\controllers\utils\Elasticsearch\ES;

class ElkLoggerReporter
{
    public $level;

    public $message;

    public $context;

    public function __construct($level, $message, array $context = [])
    {
        $this->level = $level;
        $this->message = $message;
        $this->context = $context;
    }

    public function handle()
    {
        $json = [
            'level' => $this->level,
            'message' => $this->message,
            'context' => $this->context,
        ];

        $client = Client::getInstance();
        $client->index([
            'index' => ES::ES_INDEX,
            'type' => ES::ELK_TYPE,
            'id' => uniqid(),
            'body' => $json,
        ]);
    }
}