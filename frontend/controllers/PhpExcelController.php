<?php
namespace frontend\controllers;

use common\models\Provider;
use Yii;
use yii\helpers\ArrayHelper;
use yii\console\Controller;

class PhpExcelController extends Controller
{

    public function actionIndex()
    {
        $data = $this->excel(Yii::$app->basePath . '/web/gys.xlsx');
//        foreach ($data as &$company_name) {
//            $provider_model = Provider::find()->where(['like', 'company_name', $company_name[0]])->one();
//            if (!empty($provider_model)) {
//                $company_name[1] = '是';
//            } else {
//                $company_name[1] = '否';
//            }
//        }


//        $this->create_xls($data);
//        $this->createCsv(array_slice($data,0,70));
    }

    /**
     * 数组转xls格式的excel文件
     * @param  array $data 需要生成excel文件的数组
     * @param  string $filename 生成的excel文件名
     */
    function create_xls($data, $filename = 'simple.xls')
    {
        ini_set('max_execution_time', '0');
        $filename = str_replace('.xls', '', $filename) . '.xls';
        $phpexcel = new \PHPExcel();
        $phpexcel->getProperties()
            ->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $phpexcel->getActiveSheet()->fromArray($data);
        $phpexcel->getActiveSheet()->setTitle('Sheet1');
        $phpexcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objwriter = \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
        $objwriter->save('php://output');
    }

    /**
     * 生成.csv文件
     * @param $data
     * @param null $header
     * @param string $filename
     */
    public function createCsv($data, $header = null, $filename = 'simple.csv')
    {
        // 如果手动设置表头；则放在第一行
        if (!is_null($header)) {
            array_unshift($data, $header);
        }
        // 防止没有添加文件后缀
        $filename = str_replace('.csv', '', $filename) . '.csv';
        ob_clean();
        Header("Content-type:  application/octet-stream ");
        Header("Accept-Ranges:  bytes ");
        Header("Content-Disposition:  attachment;  filename=" . $filename);
        foreach ($data as $k => $v) {
            // 如果是二维数组；转成一维
            if (is_array($v)) {
                $v = implode(',', $v);
            }
            // 替换掉换行
            $v = preg_replace('/\s*/', '', $v);
            // 解决导出的数字会显示成科学计数法的问题
            $v = str_replace(',', "\t,", $v);
            // 转成gbk以兼容office乱码的问题
            echo iconv('UTF-8', 'GBK', $v) . "\t\r\n";
        }
    }


    /**
     * 从文件导入数据
     * @param $file
     * @return array
     */
    public function excel($file)
    {
        $objPHPExcel = \PHPExcel_IOFactory::load($file);
        $sheet = $objPHPExcel->getSheet(0);
        // 取得总行数
        $highestRow = $sheet->getHighestRow();
        // 取得总列数
        $highestColumn = $sheet->getHighestColumn();
        //循环读取excel文件,读取一条,插入一条
        $data = [];
        //从第一行开始读取数据
        for ($j = 1; $j <= $highestRow; $j++) {
            //从A列读取数据
            for ($k = 'A'; $k <= $highestColumn; $k++) {
                // 读取单元格
                $data[$j][] = $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
            }
        }
        return $data;
    }


}