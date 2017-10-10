<?php namespace frontend\controllers;

class Resource
{
    private static $params = array();

    public static function getAllParams()
    {
        return self::$params;
    }
}