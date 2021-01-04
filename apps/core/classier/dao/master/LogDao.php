<?php

namespace apps\core\classier\dao\master;


use apps\core\classier\config\BaseConfig;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppLogModel;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use function rapidPHP\Cal;

class LogDao extends MasterDao
{

    /**
     * LogDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppLogModel::class);
    }


    /**
     * 添加系统日志
     * @param $id
     * @param $msg
     * @param string $content
     * @return bool
     * @throws Exception
     */
    public function addLog(&$id, $msg, $content = ''): bool
    {
        return parent::add([
            'msg' => $msg,
            'content' => $content,
            'add_time' => Cal()->getDate(),
        ], $id);
    }

    /**
     * 获取系统日志列表查询对象
     * @param $keyword
     * @param $startTime
     * @param $endTime
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getLogListSelect($keyword, $startTime, $endTime)
    {
        $select = parent::get();

        if ($startTime != '') $select->where("add_time", $startTime, '>=:');

        if ($endTime != '') $select->where("add_time", $endTime, "<:");

        if ($keyword != '') {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$keyword}%", $keyName);

            $select->where("(concat(msg, '|', content)) LIKE :{$keyName} ");
        }

        return $select;
    }


    /**
     * 获取列表
     * @param $page
     * @param $keyword
     * @param $startTime
     * @param $endTime
     * @return array
     * @throws Exception
     */
    public function getLogList($page, $keyword, $startTime, $endTime): array
    {
        $select = $this->getLogListSelect($keyword, $startTime, $endTime);

        $select->limit($page, BaseConfig::PAGE_SIZE_DEFAULT);

        return $select->order('add_time', 'DESC')
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 获取查询数量
     * @param $keyword
     * @param $startTime
     * @param $endTime
     * @return int
     * @throws Exception
     */
    public function getLogListCount($keyword, $startTime, $endTime): int
    {
        $select = $this->getLogListSelect($keyword, $startTime, $endTime);

        return (int)$select->resetSql('select')->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }
}