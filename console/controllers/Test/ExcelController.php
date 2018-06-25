<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/25
 * Time: 下午1:51
 */

namespace console\controllers\Test;

use common\components\Excel\Read\ChunkReadFilter;
use common\components\Excel\Read\ExcelToArray;
use common\components\Excel\Write\ArrayToExcel;
use yii\console\Controller;
use Yii;


class ExcelController extends Controller
{
    /**
     * 读取测试
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function actionRead()
    {
        //简单获取Excel的数据为Array
        $config = ['firstRowAsIndex' => true];
        $file = Yii::$app->basePath . '/data/file/gys.xlsx';
        $getData = new ExcelToArray($file, $config);
        $getData->load();
        dump($getData->getData());
    }

    /**
     * 分批获取Excel的数据（防止内存泄漏）
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function actionReadLimit()
    {
        $chunk = new ChunkReadFilter();
        $chunk->setRows(2);
        $file = Yii::$app->basePath . '/data/file/gys.xlsx';
        $data = new ExcelToArray($file);

        dump($data->loadByChunk($chunk)->getData());
    }

    /**
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function actionWrite()
    {
        try{
            $file = Yii::$app->basePath . '/data/file/';
            $data = [
                'fileName' => 'test.csv',           //导出的excel的文件的名称
                'sheetTitle' => '11',              //每个工作薄的标题
                'creator' => 'rekkles',            //创建者
                'writeType' => 'CSV',              //输出类型 Excel5 Excel7 CSV
                'path' => $file,    //输出路径 确保有写入权限
            ];
            //写入Excel 生成文件到指定目录
            $outObj = new ArrayToExcel($data);

            $outObj->setFirstRow(array('', 1111, 2222, 3333))
                ->fillData(array(
                    ['', 'aaa', 'bbb', 'ccc'],
                    ['', 'ddd', 'eee', 'fff'],
                ));
        }catch (\Exception $e){
            dump($e->getMessage());
        }

    }
}