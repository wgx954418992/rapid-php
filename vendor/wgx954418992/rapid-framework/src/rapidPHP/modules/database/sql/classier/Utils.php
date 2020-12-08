<?php

namespace rapidPHP\modules\database\sql\classier;


use Exception;
use rapidPHP\modules\reflection\classier\Classify;


class Utils
{


    /**
     * @var Utils
     */
    private static $instance;

    /**
     * 单例模式
     * @return self
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 格式化字段
     * @param $column
     * @param string $columnLeft
     * @param string $columnRight
     * @return mixed
     */
    public function formatColumn($column, $columnLeft = '`', $columnRight = '`')
    {
        return @preg_replace('/(\w+)/i', "{$columnLeft}$1{$columnRight}", $column);
    }

    /**
     * 获取表name
     * @param $table
     * @return mixed
     * @throws Exception
     */
    public function getTableName($table)
    {
        try {
            $classify = Classify::getInstance($table);

            /** @var DocComment $docComment */
            $docComment = $classify->getDocComment(DocComment::class);

            $tableAnnotation = $docComment->getTableAnnotation();

            return $tableAnnotation->getValue();
        } catch (Exception $e) {
            return $table;
        }
    }


    /**
     * 获取表字段
     * @param $table
     * @param null $column
     * @param string $columnLeft
     * @param string $columnRight
     * @return mixed|string
     */
    public function getTableColumn($table, $column = null, $columnLeft = '`', $columnRight = '`')
    {
        try {
            $classify = Classify::getInstance($table);

            $properties = array_column($classify->getProperties(), 'name');

            if (empty($properties)) return '*';

            return self::formatColumn(join(',', $properties), $columnLeft, $columnRight);

        } catch (Exception $e) {
            if (is_array($column)) {
                return $this->formatColumn(join(',', $column), $columnLeft, $columnRight);
            } elseif (!empty($column)) {
                return $column;
            } else {
                return '*';
            }
        }

    }

}

