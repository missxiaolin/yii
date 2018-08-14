<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 下午4:20
 */

namespace console\controllers\pattern\fluent;

// Yii 框架：CDbCommand 与 CActiveRecord 也使用此模式

/**
 * 流接口模式
 * 用来编写易于阅读的代码，就像自然语言一样（如英语）
 * Class Sql
 * @package console\controllers\pattern\fluent
 */
class Sql
{
    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var array
     */
    private $from = [];

    /**
     * @var array
     */
    private $where = [];

    /**
     * @param array $fields
     * @return Sql
     */
    public function select(array $fields): Sql
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @param string $table
     * @param string $alias
     * @return Sql
     */
    public function from(string $table, string $alias): Sql
    {
        $this->from[] = $table . ' AS ' . $alias;

        return $this;
    }

    /**
     * @param string $condition
     * @return Sql
     */
    public function where(string $condition): Sql
    {
        $this->where[] = $condition;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s',
            join(', ', $this->fields),
            join(', ', $this->from),
            join(' AND ', $this->where)
        );
    }
}