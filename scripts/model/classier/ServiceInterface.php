<?php

namespace script\model\classier;

use Generator;

interface ServiceInterface
{

    /**
     * 获取构造参数
     * @param $path
     * @param HandlerInterface $handler
     * @return Generator
     */
    public static function getInstance($path, HandlerInterface $handler);

    /**
     * 获取types
     * @param $type
     * @return array|null|string
     */
    public function getTypes($type = null);

    /**
     * getTables
     * @param $type
     * @return mixed|object|void|null
     */
    public function getTables($type);

    /**
     * getTableColumn
     * @param $type
     * @param $tableName
     * @return array
     */
    public function getTableColumn($type, $tableName);

    /**
     * getTableCreateCommand
     * @param $type
     * @param $tableName
     * @return mixed
     */
    public function getTableCreateCommand($type, $tableName);

    /**
     * 获取model
     * @param Table $table
     * @param $columns
     * @return mixed
     */
    public function getModelContent(Table $table, $columns);


    /**
     * 获取写入文件path
     * @return mixed
     */
    public function getWritePath();

    /**
     * RandId
     * @return mixed
     */
    public function getRandId();
}