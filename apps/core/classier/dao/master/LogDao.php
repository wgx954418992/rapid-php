<?php

namespace apps\core\classier\dao\master;


use apps\core\classier\bean\PageListCondition;
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
     * @param PageListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getLogListSelect(PageListCondition $condition)
    {
        $select = parent::get();

        if($condition->getStartTime()) $select->where("add_time", $condition->getStartTime(), '>=:');

        if($condition->getEndTime()) $select->where("add_time", $condition->getEndTime(), '<:');

        if ($condition->getEndTime()) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getEndTime()}%", $keyName);

            $select->where("(concat(msg, '|', content)) LIKE :{$keyName} ");
        }

        return $select;
    }


    /**
     * 获取列表
     * @param PageListCondition $condition
     * @return AppLogModel[]
     * @throws Exception
     */
    public function getLogList(PageListCondition $condition): array
    {
        $select = $this->getLogListSelect($condition);

        $select->limit($condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return (array)$select->order('add_time', 'DESC')
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 获取查询数量
     * @param PageListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getLogListCount(PageListCondition $condition): int
    {
        $select = $this->getLogListSelect($condition);

        return (int)$select->resetSql('select')->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }
}