<?php

namespace script\model\classier\service;


use Exception;
use Generator;
use rapidPHP\modules\common\classier\AB;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\database\sql\classier\SQLDB;
use rapidPHP\modules\database\sql\config\ConnectConfig;
use rapidPHP\modules\reflection\classier\Utils;
use script\model\classier\Column;
use script\model\classier\HandlerInterface;
use script\model\classier\ServiceInterface;
use script\model\classier\Table;
use script\model\classier\ToModel;

class SQLDBService implements ServiceInterface
{
    /**
     * @var SQLDB
     */
    private $db;

    /**
     * @var string|null
     */
    private $database;

    /**
     * @var ConnectConfig
     */
    private $config;

    /**
     * @var HandlerInterface
     */
    private $handler;

    /**
     * ServiceInterface constructor.
     * @param SQLDB $db
     * @param HandlerInterface $handler
     */
    public function __construct(SQLDB $db, HandlerInterface $handler)
    {
        $this->db = $db;

        $this->handler = $handler;

        $this->config = $this->db->getConfig();

        $this->database = $this->config->getDatabase();
    }

    /**
     * 获取构造参数
     * @param $path
     * @param HandlerInterface $handler
     * @return Generator
     * @throws Exception
     */
    public static function getInstance($path, HandlerInterface $handler)
    {
        $configs = ToModel::getInstance()->getConfig($path);

        /** @var AB $config */
        foreach ($configs as $file => $config) {

            $database = $config->toAB('database')->toArray('sql');

            if (empty($database)) continue;

            foreach ($database as $data) {
                if (empty($data)) continue;

                $config = Utils::getInstance()->toObject(ConnectConfig::class, $data);

                if ($config instanceof ConnectConfig && !empty($config->getUrl())) {
                    $db = new SQLDB();

                    $db->connect($config);

                    yield new SQLDBService($db, $handler);
                }
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
     * @return mixed|object|void|null
     * @throws Exception
     */
    public function getTables($type)
    {
        return $this->db->table()
            ->getTables($type, $this->database)
            ->getStatement()->fetchAll(Table::class);
    }

    /**
     * getTableColumn
     * @param $type
     * @param $tableName
     * @return array
     * @throws Exception
     */
    public function getTableColumn($type, $tableName)
    {
        return $this->db->table()
            ->getTableStructure($type, $this->database, $tableName)
            ->getStatement()
            ->fetchAll(Column::class);
    }

    /**
     * getTableCreateCommand
     * @param $type
     * @param $tableName
     * @return mixed|null
     * @throws Exception
     */
    public function getTableCreateCommand($type, $tableName)
    {
        $result = $this->db->table()->getTableCreateSql($type, $this->database, $tableName)
            ->getStatement()
            ->fetch();

        foreach ($result as $value) {
            if (is_int(strpos(strtolower($value), 'create'))) {
                return $value;
            }
        }

        return null;
    }

    /**
     *
     * 获取model内容
     * @param Table $table
     * @param $columns
     * @return mixed
     */
    public function getModelContent(Table $table, $columns)
    {
        return $this->handler->onReceive($this->config->getModel()->getNamespace(), $table, $columns);
    }


    /**
     * 获取写入path
     * @return mixed|string
     */
    public function getWritePath()
    {
        return $this->config->getModel()->getPath();
    }

    /**
     * randId
     * @return mixed|string
     */
    public function getRandId()
    {
        return md5($this->config->getDatabase());
    }
}