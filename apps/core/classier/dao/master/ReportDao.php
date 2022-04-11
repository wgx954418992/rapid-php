<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\report\Status;
use apps\core\classier\model\AppReportModel;
use Exception;
use function rapidPHP\Cal;

class ReportDao extends MasterDao
{

    /**
     * ReportDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppReportModel::class);
    }

    /**
     * 添加举报
     * @param AppReportModel $reportModel
     * @return bool
     * @throws Exception
     */
    public function addReport(AppReportModel $reportModel): bool
    {
        $result = parent::add([
            'user_id' => $reportModel->getUserId(),
            'bind_id' => $reportModel->getBindId(),
            'type' => $reportModel->getType(),
            'title' => $reportModel->getTitle(),
            'content' => $reportModel->getContent(),
            'contact' => $reportModel->getContact(),
            'status' => Status::WAITING,
            'is_delete' => false,
            'created_id' => $reportModel->getUserId(),
            'created_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) $reportModel->setId($inserId);

        return $result;
    }

    /**
     * 通过绑定id获取举报数量
     * @param $bindId
     * @return int
     * @throws Exception
     */
    public function getReportCountByBindId($bindId): int
    {
        return (int)parent::count('id')
            ->where('is_delete', false)
            ->where('bind_id', $bindId)
            ->getStatement()
            ->fetchValue('count');
    }

    /**
     * 获取用户举报数量
     * @param $userId
     * @param null $startTime
     * @param null $endTime
     * @return int
     * @throws Exception
     */
    public function getReportCountByUserId($userId, $startTime = null, $endTime = null): int
    {
        $select = parent::count('id')
            ->where('is_delete', false)
            ->where('user_id', $userId);

        if (!empty($startTime)) $select->where("created_time", $startTime, '>=:');

        if (!empty($endTime)) $select->where("created_time", $endTime, '<:');

        return (int)$select
            ->getStatement()
            ->fetchValue('count');
    }

    /**
     * 通过userId+binId获取举报
     * @param $userId
     * @param $bindId
     * @return AppReportModel
     * @throws Exception
     */
    public function getReportByUB($userId, $bindId)
    {
        return parent::get()
            ->where('is_delete', false)
            ->where('user_id', $userId)
            ->where('bind_id', $bindId)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }

    /**
     * 获取举报信息
     * @param $id
     * @return AppReportModel|null
     * @throws Exception
     */
    public function getReport($id): ?AppReportModel
    {
        return parent::get()
            ->where('id', $id)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }
}
