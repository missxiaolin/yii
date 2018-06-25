<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/25
 * Time: 下午1:42
 */

namespace common\components\Excel\Write;

use Exception;

class ArrayToExcel
{
    private $excelObj;
    private $colAttr = array(
        'A' => array(//列的属性设置
            'colName' => '',//第一行的列名
            'keyName' => '',//每一列对应的赋值数组的key值
            'width' => ''   //A列的宽度
        ),
    );      //列属性
    private $rowAttr = array(
        'firstRowHeight' => '', //第一行的列名的高度
        'height' => ''         //2-OO无从行的高度
    );      //行属性
    private $options = array(
        'fileName' => '',           //导出的excel的文件的名称
        'sheetTitle' => '',         //每个工作薄的标题
        'creator' => '',            //创建者
        'lastModified' => '',       //最近修改时间
        'title' => '',              //当前活动的主题
        'subject' => '',
        'description' => '',
        'keywords' => '',
        'category' => '',
        'writeType' => ''           //输出类型 Excel5 Excel7 CSV
    );      //文件选项
    private $validData = array();       //数据有效性
    private $colDefaultDefine = array(
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
    );  //默认列定义
    private $writeType = array(
        'excel5' => 'Excel5',
        'excel2007' => 'Excel2007',
        'csv' => 'CSV',
    );     //写入文件类型

    /**
     * ArrayToExcel constructor.
     * @param array $options
     * @throws Exception
     */
    public function __construct(array $options)
    {
        if (!isset($options['fileName'])) {
            throw new Exception('fileName is require');
        }
        if (!isset($options['path'])) {
            throw new Exception('path is require');
        }
        if (!isset($options['writeType'])) {
            throw new Exception('writeType is require');
        }

        $this->options['writeType'] = $this->writeType[strtolower($options['writeType'])];
        $this->options = $options;
        $this->excelObj = new \PHPExcel();
    }

    /**
     * 设置Excel第一行表头  一维数组/二维数组
     * @param array $col
     * @return $this
     * @throws \PHPExcel_Exception
     */
    public function setFirstRow(array $col)
    {
        if (empty($col)) {
            throw new Exception('Col is not be Null');
        }

        $this->colAttr = $col;
        $obj = $this->excelObj->getActiveSheet();

        foreach ($col as $key => $val) {
            //设置 Vertical 和 Horizontal
            $this->excelObj->getActiveSheet()
                ->getStyle($key)
                ->getAlignment()
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            //设置第一行字段名
            $colIndex = !is_array($val) ? $this->colDefaultDefine[$key] : $key;
            $colValue = !is_array($val) ? $val : $val['colName'];
            $this->excelObj->getActiveSheet()->
            setCellValue($colIndex . '1', $colValue);

            //设置列的宽度 or 跟随字体长度宽度
            if (isset($val['width']) && !empty($val['width'])) {
                $this->excelObj->getActiveSheet()->
                getColumnDimension($colIndex)->setWidth($val['width']);
            } else {
                $this->excelObj->getActiveSheet()->
                getColumnDimension($colIndex)->setAutoSize(true);
            }
        }

        return $this;
    }

    /**
     * @param array $data
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function fillData(array $data)
    {
        if (isset($this->options['lastModified'])) {
            $this->excelObj->getProperties()->setLastModifiedBy($this->options['lastModified']);
        }
        if (isset($this->options['title'])) {
            $this->excelObj->getProperties()->setTitle($this->options['title']);
        }
        if (isset($this->options['subject'])) {
            $this->excelObj->getProperties()->setSubject($this->options['subject']);
        }
        if (isset($this->options['description'])) {
            $this->excelObj->getProperties()->setDescription($this->options['description']);
        }
        if (isset($this->options['keywords'])) {
            $this->excelObj->getProperties()->setKeywords($this->options['keywords']);
        }
        if (isset($this->options['category'])) {
            $this->excelObj->getProperties()->setCategory($this->options['category']);
        }
        if (isset($this->options['category'])) {
            $this->excelObj->getProperties()->setTitle($this->options['category']);
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($this->excelObj, $this->options['writeType']);
        $objWriter->save($this->options['path'] . $this->options['fileName']);//php://output
    }
}