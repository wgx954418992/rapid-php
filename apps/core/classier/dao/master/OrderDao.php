<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\OrderListCondition;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\config\OrderConfig;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppOrderModel;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use function rapidPHP\Cal;

class OrderDao extends MasterDao
{

    public function __construct()
    {
        parent::__construct(AppOrderModel::class);
    }


    /**
     * 添加订单
     * @param AppOrderModel $orderModel
     * @return bool
     * @throws Exception
     */
    public function addOrder(AppOrderModel $orderModel): bool
    {
        return parent::add([
            'id' => $orderModel->getId(),
            'user_id' => $orderModel->getUserId(),
            'status' => OrderConfig::ORDER_STATUS_CONFIRMING,
            'is_delete' => false,
            'created_id' => $orderModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ]);
    }


    /**
     * 设置订单信息
     * @param $userId
     * @param $orderId
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function setOrder($userId, $orderId, $data): bool
    {
        $data['updated_id'] = $userId;

        $data['updated_time'] = Cal()->getDate();

        return parent::set($data)->where('id', $orderId)->execute();
    }

    /**
     * 获取订单信息
     * @param $orderId
     * @return AppOrderModel|null
     * @throws Exception
     */
    public function getOrder($orderId): ?AppOrderModel
    {
        /** @var AppOrderModel $model */
        $model = parent::get()
            ->where('id', $orderId)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 获取订单列表查询对象
     * @param OrderListCondition $condition
     * @return Driver
     * @throws Exception
     */
    public function getOrderListSelect(OrderListCondition $condition)
    {
        $select = parent::get()->where('is_delete', false);

        if ($condition->getKeyword()) {
            $keyword = $condition->getKeyword();

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$keyword}%", $keyName);

            $select->where("(concat(id,receipt_address,receipt_postcode,receipt_remark,receipt_name,remark)) LIKE :{$keyName} ");
        }

        $select->where('user_id', $condition->getUserId());

        if ($condition->getStartTime()) {
            $select->where('created_time', $condition->getStartTime(), '>=:');
        }

        if ($condition->getEndTime()) {
            $select->where('created_time', $condition->getEndTime(), '<:');
        }

        if ($condition->getStatus()) {
            $select->where('status', $condition->getStatus());
        }

        return $select;
    }

    /**
     * 获取订单列表
     * @param OrderListCondition $condition
     * @return AppOrderModel[]|null
     * @throws Exception
     */
    public function getOrderList(OrderListCondition $condition)
    {
        $orderName = $condition->getOrderName();

        return $this->getOrderListSelect($condition)
            ->order($orderName, $condition->getOrderType())
            ->limit($condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT)
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 获取订单列表数量
     * @param OrderListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getOrderListCount(OrderListCondition $condition): int
    {
        return (int)$this->getOrderListSelect($condition)
            ->resetSql('select')
            ->select('count(*) as count')
            ->getStatement()
            ->fetchValue('count');
    }


    /**
     * 删除订单
     * @param $userId
     * @param $orderId
     * @return bool
     * @throws Exception
     */
    public function delOrder($userId, $orderId): bool
    {
        return parent::set([
            'is_delete' => true,
            'updated_id' => $userId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $orderId)->execute();
    }
}