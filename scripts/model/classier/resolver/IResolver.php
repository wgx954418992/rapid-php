<?php

namespace script\model\classier\resolver;

use Generator;
use rapidPHP\modules\configure\classier\IConfigurator;
use script\model\classier\config\IHandlerConfig;
use script\model\classier\handler\IHandler;
use script\model\classier\model\ColumnModel;
use script\model\classier\model\TableModel;

interface IResolver
{


    /**
     * 获取实例
     * @param IConfigurator $configurator
     * @param IHandler $handler
     * @return Generator
     */
    public static function getInstance(IConfigurator $configurator, IHandler $handler);

    /**
     * 获取types
     * @param $type
     * @return array|null|string
     */
    public function getTypes($type = null);

    /**
     * getTables
     * @param $type
     * @return TableModel[]
     */
    public function getTables($type): array;

    /**
     * getTableColumn
     * @param $type
     * @param $tableName
     * @return ColumnModel[]
     */
    public function getTableColumn($type, $tableName): array;

    /**
     * getTableCreateCommand
     * @param $type
     * @param $tableName
     * @return string
     */
    public function getTableCreateCommand($type, $tableName): string;

    /**
     * 获取model
     * @param IHandlerConfig $config
     * @param TableModel $table
     * @param $columns
     * @return string
     */
    public function getModelContent(IHandlerConfig $config, TableModel $table, $columns): string;

    /**
     * RandId
     * @return mixed
     */
    public function getRandId();
}
