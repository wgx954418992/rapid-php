<?php

namespace apps\core\classier\dao\master\member;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\MemberOrderModel;
use Exception;
use function rapidPHP\Cal;

class OrderDao  extends MasterDao
{

    /**
     * OrderDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(MemberOrderModel::class);
    }


    /**
     * 创建订单
     * @param MemberOrderModel $model
     * @return bool
     * @throws Exception
     */
    public function addOrder(MemberOrderModel $model): bool
    {
        return parent::add([
            'id' => $model->getId(),
            'user_id' => $model->getUserId(),
            'member_id' => $model->getMemberId(),
            'total_fee' => $model->getTotalFee(),
            'status' => $model->getStatus(),
            'is_delete' => false,
            'created_id' => $model->getUserId(),
            'created_time' => Cal()->getDate(),
        ]);
    }

    /**
     * 获取订单信息
     * @param $orderId
     * @return MemberOrderModel|null
     * @throws Exception
     */
    public function getOrder($orderId): ?MemberOrderModel
    {
        /** @var MemberOrderModel $model */
        return parent::get()->where('id', $orderId)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }

    /**
     * 设置收银信息
     * @param $id
     * @param $cashierId
     * @return bool
     * @throws Exception
     */
    public function setCashier($id, $cashierId): bool
    {
        return $this->set([
            'cashier_id' => $cashierId,
        ])->where('id', $id)->execute();
    }
}
