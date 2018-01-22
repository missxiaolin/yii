<?php
namespace console\controllers\dope;


interface ClientInterface
{
    public static function getInstance();

    public function getBeginAt();
}