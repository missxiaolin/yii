<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午1:48
 */

namespace console\controllers\pattern\adapter;


use yii\console\Controller;

class CsController extends Controller
{
    public function actionTest1()
    {
        $book = new Book();
        $book->open();
        $book->turnPage();
        dump($book->getPage());
    }

    public function actionTest2()
    {
        $kindle = new Kindle();
        $book = new EBookAdapter($kindle);

        $book->open();
        $book->turnPage();
        dump($book->getPage());
    }
}