<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/25
 * Time: 下午1:44
 */

namespace common\components\Excel\Read;

use PHPExcel_Reader_IReadFilter;

class ChunkReadFilter implements PHPExcel_Reader_IReadFilter
{
    private $_startRow = 0;     // 开始行
    private $_endRow = 0;       // 跨度

    /**
     * ChunkReadFilter.
     * @param $chunkSize int 每次获取多少数据
     * @param $startRow int 默认是2 第一行常规是字段
     */
    public function setRows($chunkSize, $startRow = 2)
    {
        $this->_startRow = $startRow;
        $this->_endRow = $startRow + $chunkSize;
    }

    /**
     * @param String $column
     * @param \Row $row
     * @param string $worksheetName
     * @return bool
     */
    public function readCell($column, $row, $worksheetName = '')
    {
        if (($row == 1) || ($row >= $this->_startRow && $row < $this->_endRow)) {
            return true;
        }
        return false;
    }
}