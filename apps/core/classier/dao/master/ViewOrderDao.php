<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\OrderListCondition;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\ViewOrderModel;
use apps\core\classier\wrapper\ViewOrderWrapper;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;

class ViewOrderDao extends MasterDao
{

    /**
     * ViewOrderDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(ViewOrderModel::class);
    }

    /**
     * 获取订单信息
     * @param $orderId
     * @return ViewOrderWrapper|null
     * @throws Exception
     */
    public function getOrder($orderId): ?ViewOrderWrapper
    {
        /** @var ViewOrderWrapper $model */
        $model = parent::get()
            ->where('id', $orderId)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch(ViewOrderWrapper::class);

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

            $select->where("(concat(id,user_id,email,company_name,company_id,factory_name,factory_oid,ifnull(warehouse_name,''),ifnull(warehouse_oid,0))) LIKE :{$keyName} ");
        }

        if ($condition->getUserId()) {
            $select->where('user_id', $condition->getUserId());
        }

        if ($condition->getFactoryId()) {
            $select->where('factory_oid', $condition->getFactoryId());
        }

        if ($condition->getWarehouseId()) {
            $select->where('warehouse_oid', $condition->getWarehouseId());
        }

        if ($condition->getStartTime()) {
            $select->where('created_time', $condition->getStartTime(), '>=:');
        }

        if ($condition->getEndTime()) {
            $select->where('created_time', $condition->getEndTime(), '<:');
        }

        if ($condition->getStatus()) {
            $select->in('status', explode(',', $condition->getStatus()));
        }

        return $select;
    }

    /**
     * 获取订单列表
     * @param OrderListCondition $condition
     * @return ViewOrderWrapper[]
     * @throws Exception
     */
    public function getOrderList(OrderListCondition $condition): array
    {
        $orderName = $condition->getOrderName();

        return (array)$this->getOrderListSelect($condition)
            ->order($orderName, $condition->getOrderType())
            ->limit($condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT)
            ->getStatement()
            ->fetchAll(ViewOrderWrapper::class);
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

}