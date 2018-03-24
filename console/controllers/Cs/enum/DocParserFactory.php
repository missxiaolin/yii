<?php
namespace console\controllers\Cs\enum;

class DocParserFactory
{
    private static $p;
    private function DocParserFactory(){
    }

    public static function getInstance(){
        if(self::$p == null){
            self::$p = new DocParser ();
        }
        return self::$p;
    }
}