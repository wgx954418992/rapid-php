<?php

namespace apps\core\classier\dao\master;


use apps\core\classier\bean\LogListCondition;
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
     * @param AppLogModel $logModel
     * @return bool
     * @throws Exception
     */
    public function addLog(AppLogModel $logModel): bool
    {
        $result = $this->add([
            'type' => $logModel->getType(),
            'bind_id' => $logModel->getBindId(),
            'msg' => $logModel->getMsg(),
            'content' => $logModel->getContent(),
            'add_time' => Cal()->getDate(),
        ], $id);

        if ($result) {
            $logModel->setId($id);
        }

        return $result;
    }

    /**
     * 获取系统日志列表查询对象
     * @param LogListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getLogListSelect(LogListCondition $condition)
    {
        $select = $this->get();

        if ($condition->getType()) $select->in("type", $condition->getType());

        if ($condition->getBindId()) $select->in("type", $condition->getBindId());

        if ($condition->getStartTime()) $select->where("add_time", $condition->getStartTime(), '>=:');

        if ($condition->getEndTime()) $select->where("add_time", $condition->getEndTime(), '<:');

        if ($condition->getEndTime()) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getEndTime()}%", $keyName);

            $select->where("(concat(msg, '|', content)) LIKE :{$keyName} ");
        }

        return $select;
    }


    /**
     * 获取列表
     * @param LogListCondition $condition
     * @return AppLogModel[]
     * @throws Exception
     */
    public function getLogList(LogListCondition $condition): array
    {
        $select = $this->getLogListSelect($condition);

        $select->limit($condition->getPage(), $condition->getSize());

        return (array)$select->order('add_time', 'DESC')
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 获取查询数量
     * @param LogListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getLogListCount(LogListCondition $condition): int
    {
        $select = $this->getLogListSelect($condition);

        return (int)$select->resetSql('select')->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }
}
