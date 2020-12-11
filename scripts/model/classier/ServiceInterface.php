<?php

namespace script\model\classier;

use Generator;

interface ServiceInterface
{


    /**
     * 获取实例
     * @param $appFiles
     * @param HandlerInterface $handler
     * @return mixed
     */
    public static function getInstance($appFiles, HandlerInterface $handler);

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
    public function getTableColumn($type, $tableName): array;

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
     * @param string|null $namespace
     * @param array|null $options
     * @return mixed
     */
    public function getModelContent(Table $table, $columns, string $namespace = null, ?array $options = []);

    /**
     * RandId
     * @return mixed
     */
    public function getRandId();
}