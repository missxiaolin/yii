<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/19
 * Time: 上午10:34
 */

namespace common\components;


class CallNext
{
    public function handle(array $request, callable $next)
    {
        $request['count']++;
        return $next($request);
    }
}