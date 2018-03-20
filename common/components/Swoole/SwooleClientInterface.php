<?php
namespace common\components\Swoole;

interface SwooleClientInterface
{
    public function handle($data);

    public function flush();
}