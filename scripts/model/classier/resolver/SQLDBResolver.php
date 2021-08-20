<?php

namespace script\model\classier\resolver;


use Exception;
use Generator;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\configure\classier\IConfigurator;
use rapidPHP\modules\database\sql\classier\SQLDB;
use rapidPHP\modules\database\sql\config\ConnectConfig;
use rapidPHP\modules\reflection\classier\Utils;
use script\model\classier\config\IHandlerConfig;
use script\model\classier\handler\IHandler;
use script\model\classier\model\ColumnModel;
use script\model\classier\model\TableModel;

class SQLDBResolver implements IResolver
{

    /**
     * @var SQLDB
     */
    protected $db;

    /**
     * @var string|null
     */
    protected $database;

    /**
     * @var ConnectConfig
     */
    protected $config;

    /**
     * @var IHandler
     */
    protected $handler;

    /**
     * ServiceInterface constructor.
     * @param SQLDB $db
     * @param IHandler $handler
     */
    public function __construct(SQLDB $db, IHandler $handler)
    {
        $this->db = $db;

        $this->handler = $handler;

        $this->config = $this->db->getConfig();

        $this->database = $this->config->getDatabase();
    }

    /**
     * 获取实例
     * @param IConfigurator $configurator
     * @param IHandler $handler
     * @return Generator
     * @throws Exception
     */
    public static function getInstance(IConfigurator $configurator, IHandler $handler): Generator
    {
        $database = $configurator->getValue('database.sql');

        foreach ($database as $data) {
            if (empty($data)) continue;

            $config = Utils::getInstance()->toObject(ConnectConfig::class, $data);

            if ($config instanceof ConnectConfig && !empty($config->getUrl())) {

                $db = new SQLDB();

                $db->connect($config);

                yield new SQLDBResolver($db, $handler);
            }
        }
    }

    /**
     * 获取types
     * @param $type
     * @return array|null|string
     */
    public function getTypes($type = null)
    {
        $list = [1 => 'tables', 2 => 'views'];

        if (empty($type)) return $list;

        return Build::getInstance()->getData($list, $type);
    }

    /**
     * @param $type
     * @return TableModel[]
     * @throws Exception
     */
    public function getTables($type): array
    {
        return (array)$this->db->table()
            ->getTables($type, $this->database)
            ->getStatement()
            ->fetchAll(TableModel::class);
    }

    /**
     * getTableColumn
     * @param $type
     * @param $tableName
     * @return array
     * @throws Exception
     */
    public function getTableColumn($type, $tableName): array
    {
        return $this->db->table()
            ->getTableStructure($type, $this->database, $tableName)
            ->getStatement()
            ->fetchAll(ColumnModel::class);
    }

    /**
     * getTableCreateCommand
     * @param $type
     * @param $tableName
     * @return string
     * @throws Exception
     */
    public function getTableCreateCommand($type, $tableName): string
    {
        $result = $this->db
            ->table()
            ->getTableCreateSql($type, $this->database, $tableName)
            ->getStatement()
            ->fetch();

        foreach ($result as $value) {
            if (is_int(strpos(strtolower($value), 'create'))) {
                return $value;
            }
        }

        return '';
    }

    /**
     * 获取model内容
     * @param IHandlerConfig $config
     * @param TableModel $table
     * @param $columns
     * @return string
     */
    public function getModelContent(IHandlerConfig $config, TableModel $table, $columns): string
    {
        return $this->handler->onHandler($config, $table, $columns);
    }

    /**
     * randId
     * @return mixed|string
     */
    public function getRandId(): string
    {
        return md5($this->config->getDatabase());
    }
}
